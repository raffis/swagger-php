<?php
/**
 * File BooleanTypeTest.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace ERP\Swagger\Tests\Entity\Parameters\FormParameter;

use ERP\Swagger\Entity\Parameters\AbstractParameter;
use ERP\Swagger\Entity\Parameters\AbstractTypedParameter;
use ERP\Swagger\Entity\Parameters\FormParameter;
use ERP\Swagger\Tests\Mixin\SerializerContextTrait;

/**
 * Class BooleanTypeTest
 *
 * @package ERP\Swagger
 * @subpackage Tests\Entity\Parameters\FormParameter
 */
class BooleanTypeTest extends \PHPUnit_Framework_TestCase
{
    use SerializerContextTrait;

    /**
     * @var FormParameter\BooleanType
     */
    protected $parameter;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->parameter = new FormParameter\BooleanType();
    }

    /**
     * @covers ERP\Swagger\Entity\Parameters\FormParameter\BooleanType
     */
    public function testSerialization()
    {
        $data = json_encode([
            'in'   => AbstractParameter::IN_FORM_DATA,
            'type' => AbstractTypedParameter::BOOLEAN_TYPE,
            'name'             => 'foo',
            'description'      => 'bar',
            'required'         => false,
            'format'           => 'baz',
            'allowEmptyValues' => true,
            'default'          => false,
        ]);

        $parameter = $this->getSerializer()->deserialize($data, AbstractParameter::class, 'json');

        $this->assertInstanceOf(FormParameter\BooleanType::class, $parameter);
        $this->assertAttributeEquals(AbstractParameter::IN_FORM_DATA, 'in', $parameter);
        $this->assertAttributeEquals(AbstractTypedParameter::BOOLEAN_TYPE, 'type', $parameter);
        $this->assertAttributeEquals('foo', 'name', $parameter);
        $this->assertAttributeEquals('bar', 'description', $parameter);
        $this->assertAttributeEquals(false, 'required', $parameter);
        $this->assertAttributeEquals('baz', 'format', $parameter);
        $this->assertAttributeEquals(true, 'allowEmptyValues', $parameter);
        $this->assertAttributeEquals(false, 'default', $parameter);

        $json = $this->getSerializer()->serialize($parameter, 'json');

        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString($data, $json);
    }
}