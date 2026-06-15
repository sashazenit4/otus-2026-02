<?php

namespace Otus\Grid\Header;

final class AuthorHeaderProvider implements HeaderProviderInterface
{
    public function getHeaders(): array
    {
        return [
            ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true],
            ['id' => 'LAST_NAME', 'name' => 'Фамилия', 'sort' => 'LAST_NAME', 'default' => true],
            ['id' => 'FIRST_NAME', 'name' => 'Имя', 'sort' => 'FIRST_NAME', 'default' => true],
            ['id' => 'SECOND_NAME', 'name' => 'Отчество', 'sort' => 'SECOND_NAME', 'default' => true],
        ];
    }
}
