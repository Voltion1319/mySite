<?php

abstract class BaseModel
{
    /**
     * Return correct values for add to db
     */
    protected static function transformValues($values)
    {
        foreach ($values as &$value)
        {
            $value = trim(htmlspecialchars($value));
        }
        return $values;
    }

}