<?php

namespace App\Tests\Unit\Form;

use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;

class RegistrationFormTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $validator = Validation::createValidator();
        return [
            new ValidatorExtension($validator),
        ];
    }

    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'john.doe@tmail.fr',
            'fullname' => 'John Doe',
            'plainPassword' => [
                'first' => 'root123456',
                'second' => 'root123456',
            ]
        ];

        $model = new User();
        $model->setPassword($formData['plainPassword']['first']);
        $form = $this->factory->create(RegistrationFormType::class, $model);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model->getEmail(), $formData['email']);
        $this->assertEquals($model->getFullname(), $formData['fullname']);
        $this->assertEquals($model->getPassword(), $formData['plainPassword']['second']);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
