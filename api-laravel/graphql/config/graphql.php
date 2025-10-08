'types' => [
'Product' => \App\GraphQL\Types\ProductType::class,
],

'queries' => [
'products' => \App\GraphQL\Queries\ProductsQuery::class,
],

'graphiql' => env('GRAPHQL_GRAPHIQL', true),
