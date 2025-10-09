<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Rotas e Controller GraphQL
    |--------------------------------------------------------------------------
    |
    | Define o prefixo e controlador base para processar as requisições GraphQL.
    |
    */
    'route' => [
        'prefix' => 'graphql',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@query',
        'middleware' => [],
        'group_attributes' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Schema Padrão
    |--------------------------------------------------------------------------
    */
    'default_schema' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Batching (múltiplas requisições em um mesmo request)
    |--------------------------------------------------------------------------
    */
    'batching' => [
        'enable' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Schemas disponíveis
    |--------------------------------------------------------------------------
    */
    'schemas' => [
        'default' => [
            'query' => [
                'products' => \App\GraphQL\Queries\ProductsQuery::class,
                'me' => \App\GraphQL\Queries\Auth\MeQuery::class,
            ],
            'mutation' => [
                // 🔐 Autenticação
                'login'         => \App\GraphQL\Mutations\Auth\LoginMutation::class,
                'register'      => \App\GraphQL\Mutations\Auth\RegisterMutation::class,
                'refreshToken'  => \App\GraphQL\Mutations\Auth\RefreshTokenMutation::class,
                'logout'        => \App\GraphQL\Mutations\Auth\LogoutMutation::class,

                // 📦 Produtos
                'createProduct' => \App\GraphQL\Mutations\Product\CreateProductMutation::class,
                'updateProduct' => \App\GraphQL\Mutations\Product\UpdateProductMutation::class,
                'deleteProduct' => \App\GraphQL\Mutations\Product\DeleteProductMutation::class,
            ],
            'types' => [
                // 🔐 Autenticação
                'User'          => \App\GraphQL\Types\UserType::class,
                'LoginResponse' => \App\GraphQL\Types\LoginResponseType::class,
                'AuthPayload'   => \App\GraphQL\Types\AuthPayloadType::class,

                // 📦 Produto
                'Product'       => \App\GraphQL\Types\ProductType::class,
                'ProductPagination' => \App\GraphQL\Types\ProductPaginationType::class,
                'PaginatorInfo' => \App\GraphQL\Types\PaginatorInfoType::class,
            ],

            'middleware' => [],
            'method' => ['POST'],
            'execution_middleware' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tipos globais (disponíveis para qualquer schema)
    |--------------------------------------------------------------------------
    */
    'types' => [
        'User'          => \App\GraphQL\Types\UserType::class,
        'LoginResponse' => \App\GraphQL\Types\LoginResponseType::class,
        'AuthPayload'   => \App\GraphQL\Types\AuthPayloadType::class,
        'Product'       => \App\GraphQL\Types\ProductType::class,
        'ProductPagination' => \App\GraphQL\Types\ProductPaginationType::class,
        'PaginatorInfo' => \App\GraphQL\Types\PaginatorInfoType::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Tratamento de erros
    |--------------------------------------------------------------------------
    */
    'error_formatter' => [\Rebing\GraphQL\GraphQL::class, 'formatError'],
    'errors_handler'  => [\Rebing\GraphQL\GraphQL::class, 'handleErrors'],

    /*
    |--------------------------------------------------------------------------
    | Segurança
    |--------------------------------------------------------------------------
    |
    | query_max_complexity — impede queries muito pesadas
    | disable_introspection — desabilita introspecção em produção
    |
    */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth'      => null,
        'disable_introspection' => env('APP_ENV') === 'production',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tipos de paginação
    |--------------------------------------------------------------------------
    */
    'pagination_type'         => \Rebing\GraphQL\Support\PaginationType::class,
    'simple_pagination_type'  => \Rebing\GraphQL\Support\SimplePaginationType::class,

    /*
    |--------------------------------------------------------------------------
    | Outras configs
    |--------------------------------------------------------------------------
    */
    'defaultFieldResolver' => null,
    'headers' => [],
    'json_encoding_options' => 0,

    /*
    |--------------------------------------------------------------------------
    | Automatic Persisted Queries (APQ)
    |--------------------------------------------------------------------------
    */
    'apq' => [
        'enable' => env('GRAPHQL_APQ_ENABLE', false),
        'cache_driver' => env('GRAPHQL_APQ_CACHE_DRIVER', config('cache.default')),
        'cache_prefix' => config('cache.prefix') . ':graphql.apq',
        'cache_ttl' => 300,
    ],

    /*
    |--------------------------------------------------------------------------
    | Middlewares executados durante o ciclo do GraphQL
    |--------------------------------------------------------------------------
    */
    'execution_middleware' => [
        \Rebing\GraphQL\Support\ExecutionMiddleware\ValidateOperationParamsMiddleware::class,
        \Rebing\GraphQL\Support\ExecutionMiddleware\AutomaticPersistedQueriesMiddleware::class,
        \Rebing\GraphQL\Support\ExecutionMiddleware\AddAuthUserContextValueMiddleware::class,
    ],

    'resolver_middleware_append' => null,

    /*
    |--------------------------------------------------------------------------
    | Habilitar GraphiQL (interface web de testes)
    |--------------------------------------------------------------------------
    */
    'graphiql' => env('GRAPHQL_GRAPHIQL', true),
];
