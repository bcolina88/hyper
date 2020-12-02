<?php


return [

    /*
     * The prefix for routes
     */
    'prefix' => 'graphql',

    /*
     * The domain for routes
     */
    //'domain' => null,

    /*
     * The routes to make GraphQL request. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Route
     *
     * Example:
     *
     * Same route for both query and mutation
     *
     * 'routes' => [
     *     'query' => 'query/{graphql_schema?}',
     *     'mutation' => 'mutation/{graphql_schema?}',
     *      mutation' => 'graphiql'
     * ]
     *
     * you can also disable routes by setting routes to null
     *
     * 'routes' => null,
     */
    'routes' => '{graphql_schema?}',

    /*
     * The controller to use in GraphQL requests. Either a string that will apply
     * to both query and mutation or an array containing the key 'query' and/or
     * 'mutation' with the according Controller and method
     *
     * Example:
     *
     * 'controllers' => [
     *     'query' => '\Folklore\GraphQL\GraphQLController@query',
     *     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
     * ]
     */
    'controllers' => \Folklore\GraphQL\GraphQLController::class.'@query',

    /*
     * The name of the input variable that contain variables when you query the
     * endpoint. Most libraries use "variables", you can change it here in case you need it.
     * In previous versions, the default used to be "params"
     */
    'variables_input_name' => 'variables',

    /*
     * Any middleware for the 'graphql' route group
     */
    'middleware' => ['graphql', 'auth'],

    /**
     * Any middleware for a specific 'graphql' schema
     */
    'middleware_schema' => [
        'default' => [],
        //'default' => ['auth:api'],
    ],

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     * To disable GraphiQL, set this to null
     */
    'graphiql' => [
        'routes' => '/graphiql/{graphql_schema?}',
        'controller' => \Folklore\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'composer' => \Folklore\GraphQL\View\GraphiQLComposer::class,
    ],

    /*
     * The name of the default schema used when no arguments are provided
     * to GraphQL::schema() or when the route is used without the graphql_schema
     * parameter
     */
    'schema' => 'default',

    /*
     * The schemas for query and/or mutation. It expects an array to provide
     * both the 'query' fields and the 'mutation' fields. You can also
     * provide an GraphQL\Type\Schema object directly.
     *
     * Example:
     *
     * 'schemas' => [
     *     'default' => new Schema($config)
     * ]
     *
     * or
     *
     * 'schemas' => [
     *     'default' => [
     *         'query' => [
     *              'users' => 'App\GraphQL\Query\UsersQuery'
     *          ],
     *          'mutation' => [
     *
     *          ]
     *     ]
     * ]
     */
    'schemas' => [
        'default' => [
            'query' => [

                'userById'     => App\GraphQL\Query\UserQuery::class,
                'users'        => App\GraphQL\Query\UsersQuery::class,
                'categorys'    => App\GraphQL\Query\CategorysQuery::class,
                'roles'        => App\GraphQL\Query\RolesQuery::class,
                'roleById'     => App\GraphQL\Query\RoleByIdQuery::class,
                'providers'    => App\GraphQL\Query\ProvidersQuery::class,
                'providerById' => App\GraphQL\Query\ProviderQuery::class,
                'tables'       => App\GraphQL\Query\TablesQuery::class,
                'tableById'    => App\GraphQL\Query\TableQuery::class,
                'categorys'    => App\GraphQL\Query\CategorysQuery::class,
                'categoryById' => App\GraphQL\Query\CategoryQuery::class,
                'dishs'        => App\GraphQL\Query\DishsQuery::class,
                'dishById'     => App\GraphQL\Query\DishQuery::class,
                'sales'        => App\GraphQL\Query\SalesQuery::class,
                'expenseById'  => App\GraphQL\Query\ExpenseByIdQuery::class,
                'gastos'       => App\GraphQL\Query\ExpensesQuery::class,
                'boxeById'     => App\GraphQL\Query\BoxeByIdQuery::class,
                'cajas'        => App\GraphQL\Query\BoxesQuery::class,
                'employeeById' => App\GraphQL\Query\EmployeeByIdQuery::class,
                'empleados'    => App\GraphQL\Query\EmployeesQuery::class,
                'employeePayments'    => App\GraphQL\Query\EmployeesPaymentsQuery::class,
                'pagos'        => App\GraphQL\Query\PaymentsQuery::class,

                'saleById'     => App\GraphQL\Query\SaleByIdQuery::class,
                
                'cierres'     => App\GraphQL\Query\ClosuresQuery::class,
                'cierreDia'   => App\GraphQL\Query\DayClosureQuery::class,
                'isUser'      => App\GraphQL\Query\IsUserQuery::class,
                'permissions' => App\GraphQL\Query\PermissionsQuery::class,
                'getRoleInfo' => App\GraphQL\Query\GetRoleInfoQuery::class,

                'currencys' => App\GraphQL\Query\CurrencysQuery::class,
                'currencyById' => App\GraphQL\Query\CurrencyByIdQuery::class,

                'rates' => App\GraphQL\Query\RatesQuery::class,
                'rateById' => App\GraphQL\Query\RateByIdQuery::class,

                'companys' => App\GraphQL\Query\CompanysQuery::class,


            ],
            'mutation' => [

                'createUser' => App\GraphQL\Mutation\User\CreateUserMutation::class,
                'deleteUser' => App\GraphQL\Mutation\User\DeleteUserMutation::class,
                'updateUser' => App\GraphQL\Mutation\User\UpdateUserMutation::class,
                'updateEmailUser' => App\GraphQL\Mutation\User\UpdateEmailMutation::class,
                'resetPasswordIdUser' => App\GraphQL\Mutation\User\ResetPasswordIdMutation::class,
                'blockedUser' => App\GraphQL\Mutation\User\BlockedUserMutation::class,
                
                'deleteRole' => App\GraphQL\Mutation\Role\DeleteRoleMutation::class,
                'blockedRole' => App\GraphQL\Mutation\Role\BlockedRoleMutation::class,
                'createRolePermission' => App\GraphQL\Mutation\Role\CreateRolePermissionMutation::class,
                'updateRolePermission' => App\GraphQL\Mutation\Role\UpdateRolePermissionMutation::class,

                
                'createCategory' => App\GraphQL\Mutation\Category\CreateCategoryMutation::class,
                'deleteCategory' => App\GraphQL\Mutation\Category\DeleteCategoryMutation::class,
                'updateCategory' => App\GraphQL\Mutation\Category\UpdateCategoryMutation::class,
                'blockedCategory' => App\GraphQL\Mutation\Category\BlockedCategoryMutation::class,


                'createProvider' => App\GraphQL\Mutation\Provider\CreateProviderMutation::class,
                'deleteProvider' => App\GraphQL\Mutation\Provider\DeleteProviderMutation::class,
                'updateProvider' => App\GraphQL\Mutation\Provider\UpdateProviderMutation::class,
                'blockedProvider' => App\GraphQL\Mutation\Provider\BlockedProviderMutation::class,

                'createTable' => App\GraphQL\Mutation\Table\CreateTableMutation::class,
                'deleteTable' => App\GraphQL\Mutation\Table\DeleteTableMutation::class,
                'updateTable' => App\GraphQL\Mutation\Table\UpdateTableMutation::class,
                'blockedTable' => App\GraphQL\Mutation\Table\BlockedTableMutation::class,
                'statusTable' => App\GraphQL\Mutation\Table\StatusTableMutation::class,

                'createDish' => App\GraphQL\Mutation\Dish\CreateDishMutation::class,
                'deleteDish' => App\GraphQL\Mutation\Dish\DeleteDishMutation::class,
                'updateDish' => App\GraphQL\Mutation\Dish\UpdateDishMutation::class,
                'blockedDish' => App\GraphQL\Mutation\Dish\BlockedDishMutation::class,

                'deleteSale' => App\GraphQL\Mutation\Sale\DeleteSaleMutation::class,
                'createSale' => App\GraphQL\Mutation\Sale\CreateSaleMutation::class,
                'blockedSale' => App\GraphQL\Mutation\Sale\BlockedSaleMutation::class,
                'updateSale' => App\GraphQL\Mutation\Sale\UpdateSaleMutation::class,
                'pagarSale' => App\GraphQL\Mutation\Sale\PagarSaleMutation::class,

                'createExpense' => App\GraphQL\Mutation\Expense\CreateExpenseMutation::class,
                'deleteExpense' => App\GraphQL\Mutation\Expense\DeleteExpenseMutation::class,
                'updateExpense' => App\GraphQL\Mutation\Expense\UpdateExpenseMutation::class,

                'createBoxe' => App\GraphQL\Mutation\Boxe\CreateBoxeMutation::class,
                'deleteBoxe' => App\GraphQL\Mutation\Boxe\DeleteBoxeMutation::class,
                'updateBoxe' => App\GraphQL\Mutation\Boxe\UpdateBoxeMutation::class,

                'createEmployee' => App\GraphQL\Mutation\Employee\CreateEmployeeMutation::class,
                'deleteEmployee' => App\GraphQL\Mutation\Employee\DeleteEmployeeMutation::class,
                'updateEmployee' => App\GraphQL\Mutation\Employee\UpdateEmployeeMutation::class,
                'blockedEmployee' => App\GraphQL\Mutation\Employee\BlockedEmployeeMutation::class,

                'createPaymentEmployee' => App\GraphQL\Mutation\PaymentEmployee\CreatePaymentEmployeeMutation::class,
                'deletePaymentEmployee' => App\GraphQL\Mutation\PaymentEmployee\DeletePaymentEmployeeMutation::class,

                'deleteClosure' => App\GraphQL\Mutation\Closure\DeleteClosureMutation::class,
                'createClosure' => App\GraphQL\Mutation\Closure\CreateClosureMutation::class,
            
                'createCurrency' => App\GraphQL\Mutation\Currency\CreateCurrencyMutation::class,
                'deleteCurrency' => App\GraphQL\Mutation\Currency\DeleteCurrencyMutation::class,
                'updateCurrency' => App\GraphQL\Mutation\Currency\UpdateCurrencyMutation::class,
                'blockedCurrency' => App\GraphQL\Mutation\Currency\BlockedCurrencyMutation::class,

                'createRate' => App\GraphQL\Mutation\Rate\CreateRateMutation::class,
                'deleteRate' => App\GraphQL\Mutation\Rate\DeleteRateMutation::class,
                'updateRate' => App\GraphQL\Mutation\Rate\UpdateRateMutation::class,
                'blockedRate' => App\GraphQL\Mutation\Rate\BlockedRateMutation::class,



            ]
        ]
    ],

    /*
     * Additional resolvers which can also be used with shorthand building of the schema
     * using \GraphQL\Utils::BuildSchema feature
     *
     * Example:
     *
     * 'resolvers' => [
     *     'default' => [
     *         'echo' => function ($root, $args, $context) {
     *              return 'Echo: ' . $args['message'];
     *          },
     *     ],
     * ],
     */
    'resolvers' => [
        'default' => [
        ],
    ],

    /*
     * Overrides the default field resolver
     * Useful to setup default loading of eager relationships
     *
     * Example:
     *
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     *     // take a look at the defaultFieldResolver in
     *     // https://github.com/webonyx/graphql-php/blob/master/src/Executor/Executor.php
     * },
     */
    'defaultFieldResolver' => null,

    /*
     * The types available in the application. You can access them from the
     * facade like this: GraphQL::type('user')
     *
     * Example:
     *
     * 'types' => [
     *     'user' => 'App\GraphQL\Type\UserType'
     * ]
     *
     * or without specifying a key (it will use the ->name property of your type)
     *
     * 'types' =>
     *     'App\GraphQL\Type\UserType'
     * ]
     */
    'types' => [

        \App\GraphQL\Type\RoleType::class,
        \App\GraphQL\Type\UserType::class,
        \App\GraphQL\Type\CategoryType::class,
        \App\GraphQL\Type\RoleMappingType::class,
        \App\GraphQL\Type\ProviderType::class,
        \App\GraphQL\Type\TableType::class,
        \App\GraphQL\Type\DishType::class,
        \App\GraphQL\Type\EmployeeType::class,
        \App\GraphQL\Type\SalesType::class,
        \App\GraphQL\Type\SalesItemsType::class,
        \App\GraphQL\Type\ExpenseType::class,
        \App\GraphQL\Type\BoxeType::class,
        \App\GraphQL\Type\PaymentEmployeeType::class,
        \App\GraphQL\Type\ClosureType::class,
        \App\GraphQL\Type\DayClosureType::class,
        \App\GraphQL\Type\BooleanType::class,
        \App\GraphQL\Type\TableSaleType::class,
        \App\GraphQL\Type\PermisoType::class,
        \App\GraphQL\Type\MaestroType::class,
        \App\GraphQL\Type\RolePermisosType::class,
        \App\GraphQL\Type\CurrencyType::class,
        \App\GraphQL\Type\CountryType::class,
        \App\GraphQL\Type\RateType::class,
        \App\GraphQL\Type\PaymentSaleType::class,
        \App\GraphQL\Type\CompanyType::class,
 
        

    ],

    /*
     * This callable will receive all the Exception objects that are caught by GraphQL.
     * The method should return an array representing the error.
     *
     * Typically:
     *
     * [
     *     'message' => '',
     *     'locations' => []
     * ]
     */
    'error_formatter' => [\Folklore\GraphQL\GraphQL::class, 'formatError'],

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false
    ],

];
