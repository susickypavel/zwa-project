<?php

namespace App\Form;

use App\Entity\SaveFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SaveFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("game_info_file",FileType::class, [
                "label" => "Game Info File",
                "mapped" => false,
                "required" => true,
                "constraints" => [
                    new File([
                        "maxSize" => "5120k"
                    ])
                ]
            ]);
//            ->add("player_info_file", FileType::class, [
//                "label" => "Player Info File",
//                "mapped" => false,
//                "required" => true,
//                "constraints" => [
//                    new File([
//                        "maxSize" => "5120k"
//                    ])
//                ]
//            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SaveFile::class,
        ]);
    }
}
