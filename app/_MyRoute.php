<?php

class MyRoute {

    // If EMIT_ROUTE_STATEMENTS, create the directory /tmp/controllerRoutes and
    // write one file each time we are called with the Route command that can
    // be used to replace the AdvancedRoute command in the routes file.
    //
    // Since Laravel has officially deprecated the Route::controller, if we want
    // to do the same, let's have this class emit the route statements we need.
    const EMIT_ROUTE_STATEMENTS = false;

    private static $httpMethods = ['any', 'get', 'post', 'put', 'patch', 'delete'];
    private static $methodNameAtStartOfStringPattern = null;

    public static function controller($path, $controllerClassName, $namespace) {
        $class = new ReflectionClass($namespace."\\".$controllerClassName);
        $routes = [];

        $publicMethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $methods = [];
        foreach ($publicMethods as $method) {
            if ($method->name == 'getMiddleware') {
                continue;
            }

            $method->slug = self::slug($method);
            $methods[] = $method;
        }
        usort($methods, function($a, $b) {
            $aHasParam = false !== strpos($a->slug, '{');
            $bHasParam = false !== strpos($b->slug, '{');

            if (!$aHasParam && $bHasParam) {
                return -1;
            }
            if (!$bHasParam && $aHasParam) {
                return 1;
            }
            return (strcmp($a->slug, $b->slug));
        });
        foreach ($methods as $method) {
            $slug = $method->slug;
            $methodName = $method->name;

            $httpMethod = null;
            foreach (self::$httpMethods as $httpMethod) {
                if (self::stringStartsWith($methodName, $httpMethod)) {
                    Route::$httpMethod($path . '/' . $slug, ['uses'=>$controllerClassName. '@' . $methodName, 'as'=>   $controllerClassName.'.'.$methodName] );

                    $route = new \stdClass();
                    $route->httpMethod = $httpMethod;
                    $route->prefix = sprintf("Route::%-4s('%s',", $httpMethod, $path . '/' . $slug);
                    $route->target = $controllerClassName . '@' . $methodName;
                    $routes[] = $route;
                    break;
                }
            }
        }
        if (self::EMIT_ROUTE_STATEMENTS) {
            self::emitRoutes($routes);
        }
    }

    protected static function stringStartsWith($string, $match) {
        return (substr($string, 0, strlen($match)) == $match) ? true : false;
    }

    protected static function slug($method) {

        if (!self::$methodNameAtStartOfStringPattern) {
            self::$methodNameAtStartOfStringPattern = '/^(' . implode('|', self::$httpMethods) . ')/';
        }

        $cleaned = preg_replace(self::$methodNameAtStartOfStringPattern, '', $method->name);
        $snaked = \Illuminate\Support\Str::snake($cleaned, ' ');
        $slug = str_slug($snaked, '-');

        if ($slug == "index") {
            $slug = "";
        }

        foreach ($method->getParameters() as $parameter) {
            if (self::hasType($parameter)) {
                continue;
            }
            $slug .= sprintf('/{%s%s}', strtolower($parameter->getName()), $parameter->isDefaultValueAvailable() ? '?' : '');
        }

        if ($slug != null && $slug[0] == '/') {
            return substr($slug, 1);
        }

        return $slug;
    }

    protected static function hasType(ReflectionParameter $param) {
        preg_match('/\[\s\<\w+?>\s([\w]+)/s', $param->__toString(), $matches);
        return isset($matches[1]) ? true : false;
    }

    protected static function emitRoutes($routes) {
        $maxPrefixLen = 0;
        array_walk($routes, function($route) use (&$maxPrefixLen) {
            $l = strlen($route->prefix);
            if ($l > $maxPrefixLen) {
                $maxPrefixLen = $l;
            }
        });

        if (!is_dir('/tmp/controllerRoutes')) {
            mkdir('/tmp/controllerRoutes');
        }

        $routeList = sprintf("<?php\n// %s \"Controller\" Routes\n", $controllerClassName);
        foreach ($routes as $route) {
            $routeList .= sprintf("%-{$maxPrefixLen}s '%s');\n", $route->prefix, $route->target);
        }

        file_put_contents("/tmp/controllerRoutes/{$controllerClassName}.php", $routeList . PHP_EOL);
    }

}