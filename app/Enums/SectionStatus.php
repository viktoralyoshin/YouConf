<?php

namespace App\Enums;

enum SectionStatus: string
{
    case PLANNED = 'planned';
    case REGISTRATION = 'registration';
    case ONGOING = 'ongoing';
    case FINISHED = 'finished';

    public function label(): string
    {
        return match ($this) {
            self::PLANNED => 'Запланирована',
            self::REGISTRATION => 'Регистрация участников',
            self::ONGOING => 'Идёт',
            self::FINISHED => 'Прошла',
        };
    }
}
