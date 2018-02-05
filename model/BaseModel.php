<?php

abstract class BaseModel
{
    protected function transformValues($values)
    {
        foreach ($values as &$value)
        {
            $value = trim(htmlspecialchars($value));
        }
        return $values;
    }

}