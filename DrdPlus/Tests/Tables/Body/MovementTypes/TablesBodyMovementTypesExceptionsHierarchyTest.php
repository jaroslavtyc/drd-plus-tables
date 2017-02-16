<?php
namespace DrdPlus\Tests\Tables\Body\MovementTypes;

use DrdPlus\Tables\Table;
use Granam\Tests\ExceptionsHierarchy\Exceptions\AbstractExceptionsHierarchyTest;

class TablesBodyMovementTypesExceptionsHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return str_replace('\Tests', '', __NAMESPACE__);
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        $tableReflection = new \ReflectionClass(Table::class);

        return $tableReflection->getNamespaceName();
    }

}