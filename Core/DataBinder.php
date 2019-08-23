<?php


namespace Core;


class DataBinder implements DataBinderInterface
{

    public function bind($data, $className)
    {
        $obj = new $className();

        foreach ($data as $key => $value) {
            $methodName = 'set' . implode('', array_map(function($element) {
                    return ucfirst($element);
                }, explode('_', $key))); // first_name -> ['first', 'name'] -> ['First', 'Name'] -> setFirstName

            if(method_exists($obj, $methodName)) {
                $obj->$methodName($value);
            }
        }

        return $obj;
    }
}