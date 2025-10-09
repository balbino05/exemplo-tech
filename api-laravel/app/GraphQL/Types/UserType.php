<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class UserType extends GraphQLType
{
   protected $attributes = [
      'name' => 'User',
      'description' => 'Representa um usuário autenticado no sistema',
      'model' => \App\Models\User::class,
   ];

   public function fields(): array
   {
      return [
         'id' => [
            'type' => Type::nonNull(Type::int()),
            'description' => 'ID único do usuário',
         ],
         'name' => [
            'type' => Type::string(),
            'description' => 'Nome completo do usuário',
         ],
         'email' => [
            'type' => Type::string(),
            'description' => 'Endereço de e-mail',
         ],
         'created_at' => [
            'type' => Type::string(),
            'description' => 'Data de criação do usuário',
            'resolve' => fn($root) => $root->created_at?->toDateTimeString(),
         ],
         'updated_at' => [
            'type' => Type::string(),
            'description' => 'Última data de atualização',
            'resolve' => fn($root) => $root->updated_at?->toDateTimeString(),
         ],
      ];
   }
}
