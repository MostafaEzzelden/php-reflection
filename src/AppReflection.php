<?php
namespace App;

use ReflectionFunction;

class AppReflection
{
    public static function reflectClass($className)
    {
        if (class_exists($className)) {
            return new $className;
        }
    }

    public static function reflectFunction(callable $function)
    {
        $reflection = new ReflectionFunction($function);
        $parameters = $reflection->getParameters();
        if (!empty($parameters)) {
            $parametersResult = [];
            foreach ($parameters as $param) {
                // var_dump(get_class_methods($param));
                if ($class = $param->getClass()) {
                    // var_dump(get_class_methods($class));
                    $parametersResult[] = AppReflection::reflectClass($class->getName());
                }
            }
            return call_user_func_array($function, $parametersResult);
        }

        return $function();
    }
}
