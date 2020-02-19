<?php


return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each routes
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    //     'mutation' => 'graphiql'
    // ]
    //
    // you can also disable routes by setting routes to null
    //
    // 'routes' => null,
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Folklore\GraphQL\GraphQLController@query',
    //     'mutation' => '\Folklore\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Folklore\GraphQL\GraphQLController::class.'@query',

    // The name of the input that contain variables when you query the endpoint.
    // Some library use "variables", you can change it here. "params" will stay
    // the default for now but will be changed to "variables" in the next major
    // release.
    'variables_input_name' => 'variables',

    // Any middleware for the graphql route group
    'middleware' => [],

     // Any headers that will be added to the response returned by the default controller
    'headers' => [],

    // Any json encoding options when returning a response from the default controller
    // See http://php.net/manual/function.json-encode.php for list of options
    'json_encoding_options' => 0,

    // Config for GraphiQL (https://github.com/graphql/graphiql).
    // To disable GraphiQL, set this to null.
    'graphiql' => [
        'routes' => '/graphiql/{graphql_schema?}',
        'middleware' => [],
        'controller' => \Folklore\GraphQL\GraphQLController::class.'@graphiql',
        'view' => 'graphql::graphiql'
    ],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'schema' => 'default',

    // The schemas for query and/or mutation. It expects an array to provide
    // both the 'query' fields and the 'mutation' fields. You can also
    // provide directly an object GraphQL\Schema
    //
    // Example:
    //
    // 'schemas' => [
    //     'default' => new Schema($config)
    // ]
    //
    // or
    //
    // 'schemas' => [
    //     'default' => [
    //         'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //     ]
    // ]
    //
    'schemas' => [
        'default' => [
            'query' => [

                'getCurrent' => App\GraphQL\Query\GetCurrentQuery::class,

                'userByID' => App\GraphQL\Query\UserQuery::class,
                'userPagination' => App\GraphQL\Query\UsersPaginationQuery::class,
                'users' => App\GraphQL\Query\UsersQuery::class,

                'roleByID' => App\GraphQL\Query\RoleQuery::class,
                'rolePagination' => App\GraphQL\Query\RolesPaginationQuery::class,
                'roles' => App\GraphQL\Query\RolesQuery::class,

                'discountCouponByID' => App\GraphQL\Query\DiscountCouponQuery::class,
                'discountCouponPagination' => App\GraphQL\Query\DiscountCouponsPaginationQuery::class,
                'discountCoupons' => App\GraphQL\Query\DiscountCouponsQuery::class,

                'notificationByID' => App\GraphQL\Query\NotificationQuery::class,
                'notificationPagination' => App\GraphQL\Query\NotificationsPaginationQuery::class,
                'notifications' => App\GraphQL\Query\NotificationsQuery::class,

                'driverByID' => App\GraphQL\Query\DriverQuery::class,
                'driverPagination' => App\GraphQL\Query\DriversPaginationQuery::class,
                'drivers' => App\GraphQL\Query\DriversQuery::class,

                'riderByID' => App\GraphQL\Query\RiderQuery::class,
                'riderPagination' => App\GraphQL\Query\RidersPaginationQuery::class,
                'riders' => App\GraphQL\Query\RidersQuery::class,

                'distanceCalculation' => App\GraphQL\Query\DistanceCalculationQuery::class,
                'activeDrivers' => App\GraphQL\Query\ActiveDriversQuery::class,

                'carByID' => App\GraphQL\Query\CarQuery::class,
                'carPagination' => App\GraphQL\Query\CarsPaginationQuery::class,
                'cars' => App\GraphQL\Query\CarsQuery::class,

                'updateDriverLocation' => App\GraphQL\Query\UpdateDriverLocationQuery::class,
                'updateRiderLocation' => App\GraphQL\Query\UpdateRiderLocationQuery::class,

                'currencyRatePagination' => App\GraphQL\Query\CurrencyRatesPaginationQuery::class,
                'currencyRates'=> App\GraphQL\Query\CurrencyRatesQuery::class,
                'currencyRateByID'=> App\GraphQL\Query\CurrencyRateQuery::class,

                'bankByID' => App\GraphQL\Query\BankQuery::class,
                'bankPagination' => App\GraphQL\Query\BanksPaginationQuery::class,
                'banks' => App\GraphQL\Query\BanksQuery::class,

                'bankAccountByID' => App\GraphQL\Query\BankAccountQuery::class,
                'bankAccountPagination' => App\GraphQL\Query\BankAccountsPaginationQuery::class,
                'bankAccounts' => App\GraphQL\Query\BankAccountsQuery::class,

                'travelRatePagination' => App\GraphQL\Query\TravelRatesPaginationQuery::class,
                'travelRates'=> App\GraphQL\Query\TravelRatesQuery::class,
                'travelRateByID'=> App\GraphQL\Query\TravelRateQuery::class,

                'locationPagination' => App\GraphQL\Query\LocationsPaginationQuery::class,
                'locations'=> App\GraphQL\Query\LocationsQuery::class,
                'locationByID'=> App\GraphQL\Query\LocationQuery::class,

                'activeServices' => App\GraphQL\Query\ActiveServicesQuery::class,
                'lastTrips' => App\GraphQL\Query\LastTripsQuery::class,

            ],
            'mutation' => [

                //'userProfile' =>  App\GraphQL\Mutation\UserProfilePhotoMutation::class,
                'login' => App\GraphQL\Mutation\Auth\CreateTokenMutation::class,
                'refreshToken' => App\GraphQL\Mutation\Auth\RefreshTokenMutation::class,
                'logout' => App\GraphQL\Mutation\Auth\LogoutMutation::class,
                'createRole' => App\GraphQL\Mutation\Role\CreateRoleMutation::class,
                'deleteRole' => App\GraphQL\Mutation\Role\DeleteRoleMutation::class,
                'updateRole' => App\GraphQL\Mutation\Role\UpdateRoleMutation::class,
                'blockedRole' => App\GraphQL\Mutation\Role\BlockedRoleMutation::class,

                'createRider' => App\GraphQL\Mutation\Rider\CreateRiderMutation::class,
                'deleteRider' => App\GraphQL\Mutation\Rider\DeleteRiderMutation::class,
                'blockedRider' => App\GraphQL\Mutation\Rider\BlockedRiderMutation::class,

                'createDriver' => App\GraphQL\Mutation\Driver\CreateDriverMutation::class,
                'deleteDriver' => App\GraphQL\Mutation\Driver\DeleteDriverMutation::class,
                'blockedDriver' => App\GraphQL\Mutation\Driver\BlockedDriverMutation::class,

                'createDiscountCoupon' => App\GraphQL\Mutation\DiscountCoupon\CreateDiscountCouponMutation::class,
                'deleteDiscountCoupon' => App\GraphQL\Mutation\DiscountCoupon\DeleteDiscountCouponMutation::class,
                'updateDiscountCoupon' => App\GraphQL\Mutation\DiscountCoupon\UpdateDiscountCouponMutation::class,
                'blockedDiscountCoupon' => App\GraphQL\Mutation\DiscountCoupon\BlockedDiscountCouponMutation::class,

                'createUser' => App\GraphQL\Mutation\User\CreateUserMutation::class,
                'deleteUser' => App\GraphQL\Mutation\User\DeleteUserMutation::class,
                'updateUser' => App\GraphQL\Mutation\User\UpdateUserMutation::class,
                'updateEmailUser' => App\GraphQL\Mutation\User\UpdateEmailMutation::class,
                'resetPasswordUser' => App\GraphQL\Mutation\User\ResetPasswordMutation::class,
                'resetPasswordIdUser' => App\GraphQL\Mutation\User\ResetPasswordIdMutation::class,
                'blockedUser' => App\GraphQL\Mutation\User\BlockedUserMutation::class,
                'updateLastNames' => App\GraphQL\Mutation\User\UpdateLastNamesMutation::class,
                'updateNames' => App\GraphQL\Mutation\User\UpdateNamesMutation::class,
                'updatePhone' => App\GraphQL\Mutation\User\UpdatePhoneMutation::class,
                'updateFirstAndLastName' => App\GraphQL\Mutation\User\UpdateFirstAndLastNameMutation::class,


                'createNotification' => App\GraphQL\Mutation\Notification\CreateNotificationMutation::class,
                'deleteNotification' => App\GraphQL\Mutation\Notification\DeleteNotificationMutation::class,
                'updateNotification' => App\GraphQL\Mutation\Notification\UpdateNotificationMutation::class,
                'stateNotification' => App\GraphQL\Mutation\Notification\StateNotificationMutation::class,

                'createRating' => App\GraphQL\Mutation\Rating\CreateRatingMutation::class,
                'createCar' => App\GraphQL\Mutation\Car\CreateCarMutation::class,

                'blockedCurrencyRate' => App\GraphQL\Mutation\CurrencyRate\BlockedCurrencyRateMutation::class,
                'deleteCurrencyRate' => App\GraphQL\Mutation\CurrencyRate\DeleteCurrencyRateMutation::class,
                'updateCurrencyRate' => App\GraphQL\Mutation\CurrencyRate\UpdateCurrencyRateMutation::class,
                'createCurrencyRate' => App\GraphQL\Mutation\CurrencyRate\CreateCurrencyRateMutation::class,

                'createPayment' => App\GraphQL\Mutation\Payment\CreatePaymentMutation::class,
                'deletePayment' => App\GraphQL\Mutation\Payment\DeletePaymentMutation::class,
                'updatePayment' => App\GraphQL\Mutation\Payment\UpdatePaymentMutation::class,

                'createRide' => App\GraphQL\Mutation\Ride\CreateRideMutation::class,
                'statusRide' => App\GraphQL\Mutation\Ride\StatusRideMutation::class,

                'blockedTravelRate' => App\GraphQL\Mutation\TravelRate\BlockedTravelRateMutation::class,
                'deleteTravelRate' => App\GraphQL\Mutation\TravelRate\DeleteTravelRateMutation::class,
                'updateTravelRate' => App\GraphQL\Mutation\TravelRate\UpdateTravelRateMutation::class,
                'createTravelRate' => App\GraphQL\Mutation\TravelRate\CreateTravelRateMutation::class,

                'createBank' => App\GraphQL\Mutation\Bank\CreateBankMutation::class,
                'deleteBank' => App\GraphQL\Mutation\Bank\DeleteBankMutation::class,
                'updateBank' => App\GraphQL\Mutation\Bank\UpdateBankMutation::class,

                'createBankAccount' => App\GraphQL\Mutation\BankAccount\CreateBankAccountMutation::class,
                'deleteBankAccount' => App\GraphQL\Mutation\BankAccount\DeleteBankAccountMutation::class,
                'updateBankAccount' => App\GraphQL\Mutation\BankAccount\UpdateBankAccountMutation::class,

                'createLocation' => App\GraphQL\Mutation\Location\CreateLocationMutation::class,
                'deleteLocation' => App\GraphQL\Mutation\Location\DeleteLocationMutation::class,
                'updateLocation' => App\GraphQL\Mutation\Location\UpdateLocationMutation::class,

                'createPaymentMethod' => App\GraphQL\Mutation\PaymentMethod\CreatePaymentMethodMutation::class,
                'deletePaymentMethod' => App\GraphQL\Mutation\PaymentMethod\DeletePaymentMethodMutation::class,
                'updatePaymentMethod' => App\GraphQL\Mutation\PaymentMethod\UpdatePaymentMethodMutation::class,
                'blockedPaymentMethod' => App\GraphQL\Mutation\PaymentMethod\BlockedPaymentMethodMutation::class,



            ]
        ],
        'secret' => [
            'query' => [
            ],
            'mutation' => [
            ],
        ]
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    // or whitout specifying a key (it will use the ->name property of your type)
    //
    // 'types' => [
    //     'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [

        \App\GraphQL\Type\UserPaginationType::class,
        \App\GraphQL\Type\RolePaginationType::class,
        \App\GraphQL\Type\DiscountCouponPaginationType::class,
        \App\GraphQL\Type\NotificationPaginationType::class,
        \App\GraphQL\Type\DriverPaginationType::class,
        \App\GraphQL\Type\RiderPaginationType::class,
        \App\GraphQL\Type\AuthType::class,
        \App\GraphQL\Type\StringType::class,
        \App\GraphQL\Type\RoleType::class,
        \App\GraphQL\Type\UserType::class,
        \App\GraphQL\Type\RoleMappingType::class,
        \App\GraphQL\Type\MarcaType::class,
        \App\GraphQL\Type\ModelCarType::class,
        \App\GraphQL\Type\RatingType::class,
        \App\GraphQL\Type\RiderType::class,
        \App\GraphQL\Type\DriverType::class,
        \App\GraphQL\Type\DriverHasCarType::class,
        \App\GraphQL\Type\TypeCarType::class,
        \App\GraphQL\Type\CarType::class,
        \App\GraphQL\Type\RideRequestType::class,
        \App\GraphQL\Type\RideType::class,
        \App\GraphQL\Type\BankType::class,
        \App\GraphQL\Type\BankAccountType::class,
        \App\GraphQL\Type\PaymentType::class,
        \App\GraphQL\Type\CurrencyType::class,
        \App\GraphQL\Type\CurrencyRateType::class,
        \App\GraphQL\Type\TravelRateType::class,
        \App\GraphQL\Type\UserAuthType::class,
        \App\GraphQL\Type\DiscountCouponType::class,
        \App\GraphQL\Type\NotificationType::class,
        \App\GraphQL\Type\RiderHasCouponType::class,
        \App\GraphQL\Type\LocationType::class,
        \App\GraphQL\Type\FloatType::class,
        \App\GraphQL\Type\ActiveDriverType::class,
        \App\GraphQL\Type\RideHasPaymentType::class,
        \App\GraphQL\Type\CurrencyRatePaginationType::class,
        \App\GraphQL\Type\BankPaginationType::class,
        \App\GraphQL\Type\BankAccountPaginationType::class,
        \App\GraphQL\Type\TravelRatePaginationType::class,
        \App\GraphQL\Type\CarPaginationType::class,
        \App\GraphQL\Type\LocationPaginationType::class,
        \App\GraphQL\Type\ActiveServiceType::class,
        \App\GraphQL\Type\PaymentMethodType::class,
        \App\GraphQL\Type\GetCurrentType::class,

        /*\App\GraphQL\Type\AuthType::class,
        \App\GraphQL\Type\CountryType::class,
        \App\GraphQL\Type\StateType::class,
        \App\GraphQL\Type\StatusType::class,
        \App\GraphQL\Type\RoleType::class,
        \App\GraphQL\Type\UserType::class,
        \App\GraphQL\Type\BankType::class,
        \App\GraphQL\Type\BankAccountType::class,
        \App\GraphQL\Type\PaymentType::class,
        \App\GraphQL\Type\PurchaseRequestType::class,
        \App\GraphQL\Type\PurchaseRequestHasPaymentType::class,
        \App\GraphQL\Type\PurchaseRequestHasBudgetHasProductType::class,
        \App\GraphQL\Type\RoleMappingType::class,
        \App\GraphQL\Type\EventType::class,
        \App\GraphQL\Type\LocationType::class,
        \App\GraphQL\Type\ZoneType::class,
        \App\GraphQL\Type\AccessType::class,
        \App\GraphQL\Type\CategoryType::class,
        \App\GraphQL\Type\ProviderType::class,
        \App\GraphQL\Type\ProductType::class,
        \App\GraphQL\Type\BudgetHasProductType::class,
        \App\GraphQL\Type\BudgetType::class,
        \App\GraphQL\Type\TypeInvitedType::class,
        \App\GraphQL\Type\InvitedType::class,
        \App\GraphQL\Type\RolePaginationType::class,
        \App\GraphQL\Type\AccessPaginationType::class,
        \App\GraphQL\Type\BankPaginationType::class,
        \App\GraphQL\Type\BankAccountPaginationType::class,
        \App\GraphQL\Type\EventPaginationType::class,
        \App\GraphQL\Type\InvitedPaginationType::class,
        \App\GraphQL\Type\LocationPaginationType::class,
        \App\GraphQL\Type\PaymentPaginationType::class,
        \App\GraphQL\Type\UserPaginationType::class,
        \App\GraphQL\Type\SearchType::class,
        \App\GraphQL\Type\ZonePaginationType::class,
        \App\GraphQL\Type\PurchaseRequestPaginationType::class,
        \App\GraphQL\Type\AccessesByEventType::class,
        \App\GraphQL\Type\HotelType::class,
        \App\GraphQL\Type\RoomType::class,
        \App\GraphQL\Type\ReservationType::class,
        \App\GraphQL\Type\ReservationAutocompleteType::class,
        \App\GraphQL\Type\AccessesByEventPaginationType::class,
        \App\GraphQL\Type\PaymentReservationType::class,
        \App\GraphQL\Type\ReservationHasPaymentType::class,
        \App\GraphQL\Type\PurchaseRequestAutocompleteType::class,
        \App\GraphQL\Type\RoomPaginationType::class,
        \App\GraphQL\Type\ReservationPaginationType::class,
        \App\GraphQL\Type\PaymentReservationPaginationType::class,
        \App\GraphQL\Type\HotelPaginationType::class,
        \App\GraphQL\Type\ResponseType::class,
        \App\GraphQL\Type\ProviderPaginationType::class,
        \App\GraphQL\Type\MovementType::class,
        \App\GraphQL\Type\MovementPaginationType::class,
        \App\GraphQL\Type\MailType::class,
        \App\GraphQL\Type\CurrencyType::class,
        \App\GraphQL\Type\RateType::class,
        \App\GraphQL\Type\CurrencyPaginationType::class,
        \App\GraphQL\Type\RatePaginationType::class,
        \App\GraphQL\Type\CurrencyHasEventType::class,
        \App\GraphQL\Type\CurrencyHasEventPaginationType::class,
        \App\GraphQL\Type\BankAccountMovementType::class,
        \App\GraphQL\Type\BankAccountMovementPaginationType::class,
        \App\GraphQL\Type\CategoryPaginationType::class,
        \App\GraphQL\Type\ProductPaginationType::class,
        \App\GraphQL\Type\BudgetByEventPaginationType::class,
        \App\GraphQL\Type\BudgetByEventPaginationType::class,
        \App\GraphQL\Type\PaymentBudgetType::class,
        \App\GraphQL\Type\BudgetProductType::class,
        \App\GraphQL\Type\PresentationType::class,
        \App\GraphQL\Type\UnitMeasureType::class,
        \App\GraphQL\Type\StorageUnitType::class,
        \App\GraphQL\Type\ConsumableType::class,
        \App\GraphQL\Type\ServiceType::class,
        \App\GraphQL\Type\ServiceItemType::class,
        \App\GraphQL\Type\DepositType::class,
        \App\GraphQL\Type\DepositProductType::class,
        \App\GraphQL\Type\BarType::class,
        \App\GraphQL\Type\DepositBarEventType::class,
        \App\GraphQL\Type\DepositMovementType::class,
        \App\GraphQL\Type\SaleType::class,
        \App\GraphQL\Type\SaleItemType::class,
        \App\GraphQL\Type\SpecialDiscountType::class,


        \App\GraphQL\Type\BarPaginationType::class,
        \App\GraphQL\Type\DepositProductPaginationType::class,
        \App\GraphQL\Type\DepositBarEventPaginationType::class,
        \App\GraphQL\Type\PresentationPaginationType::class,
        \App\GraphQL\Type\UnitMeasurePaginationType::class,
        \App\GraphQL\Type\StorageUnitPaginationType::class,

        \App\GraphQL\Type\ConsumablePaginationType::class,
        \App\GraphQL\Type\ServicePaginationType::class,
        \App\GraphQL\Type\DepositPaginationType::class,
        \App\GraphQL\Type\ServiceItemPaginationType::class,
        \App\GraphQL\Type\DepositMovementPaginationType::class,
        \App\GraphQL\Type\SalePaginationType::class,
        \App\GraphQL\Type\SaleItemPaginationType::class,
        \App\GraphQL\Type\SpecialDiscountPaginationType::class,*/



    ],

    // This callable will received every Error objects for each errors GraphQL catch.
    // The method should return an array representing the error.
    //
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    //
    'error_formatter' => [\Folklore\GraphQL\GraphQL::class, 'formatError'],

    // Options to limit the query complexity and depth. See the doc
    // @ https://github.com/webonyx/graphql-php#security
    // for details. Disabled by default.
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false

    ],
    'params_key' => 'params'
];
