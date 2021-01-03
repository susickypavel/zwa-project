<?php

namespace App\Form;

use App\Entity\WorldUpload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotNull;

class WorldUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("saveGameInfo", FileType::class, [
                "mapped" => false,
                "constraints" => [
                    new File([
                        "maxSize" => "5M"
                    ]),
                    new NotNull([
                        "message" => "Prosím nahrajte soubor SaveGameInfo"
                    ])
                ]
            ])
            ->add("worldState", FileType::class, [
                "mapped" => false,
                "constraints" => [
                    new File([
                        "maxSize" => "5M"
                    ]),
                    new NotNull([
                        "message" => "Prosím nahrajte soubor <jménohráče>_<id>"
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WorldUpload::class,
        ]);
    }
}
