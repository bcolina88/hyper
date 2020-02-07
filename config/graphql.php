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



                /*'states' => App\GraphQL\Query\StatesQuery::class,

                'expensesMovementQuery' => App\GraphQL\Query\ExpensesMovementQuery::class,
                'incomeMovementQuery' => App\GraphQL\Query\IncomeMovementQuery::class,

                'getCurrent' => App\GraphQL\Query\GetCurrentQuery::class,

                'user' => App\GraphQL\Query\UserQuery::class,
                'users' => App\GraphQL\Query\UsersPaginationQuery::class,
                'userss' => App\GraphQL\Query\UsersQuery::class,
                'pagedUsersFilter' => App\GraphQL\Query\PagedUsersFilterQuery::class,

                'location' => App\GraphQL\Query\LocationQuery::class,
                'locations' => App\GraphQL\Query\LocationsPaginationQuery::class,
                'locationss' => App\GraphQL\Query\LocationsQuery::class,

                'event' => App\GraphQL\Query\EventQuery::class,
                'events' => App\GraphQL\Query\EventsPaginationQuery::class,
                'eventss' => App\GraphQL\Query\EventsQuery::class,
                'eventsByCurrency' => App\GraphQL\Query\EventsByCurrencyQuery::class,

                'acces' => App\GraphQL\Query\AccesQuery::class,
                'access' => App\GraphQL\Query\AccessPaginationQuery::class,
                'userRole' => App\GraphQL\Query\UserRoleQuery::class,
                'accesss' => App\GraphQL\Query\AccessQuery::class,

                'bank' => App\GraphQL\Query\BankQuery::class,
                'banks' => App\GraphQL\Query\BanksPaginationQuery::class,
                'bankss' => App\GraphQL\Query\BanksQuery::class,

                'bankAccount' => App\GraphQL\Query\BankAccountQuery::class,
                'bankAccounts' => App\GraphQL\Query\BankAccountsPaginationQuery::class,
                'bankAccountss' => App\GraphQL\Query\BankAccountsQuery::class,

                'invited' => App\GraphQL\Query\InvitedQuery::class,
                'inviteds' => App\GraphQL\Query\InvitedsPaginationQuery::class,

                'role' => App\GraphQL\Query\RoleQuery::class,
                'roles' => App\GraphQL\Query\RolesPaginationQuery::class,
                'roless' => App\GraphQL\Query\RolesQuery::class,

                'account' => App\GraphQL\Query\AccountQuery::class,

                'payment' => App\GraphQL\Query\PaymentQuery::class,
                'payments' => App\GraphQL\Query\PaymentsPaginationQuery::class,
                'allPayments' => App\GraphQL\Query\AllPaymentsQuery::class,
                'search' => App\GraphQL\Query\SearchQuery::class,

                'countrys' => App\GraphQL\Query\CountrysQuery::class,

                'statuss' => App\GraphQL\Query\StatussQuery::class,

                'zoness' => App\GraphQL\Query\ZonesPaginationQuery::class,
                'zones' => App\GraphQL\Query\ZonesQuery::class,

                'typeInvits' => App\GraphQL\Query\TypeInvitedsQuery::class,

                'userListByRole' => App\GraphQL\Query\UserListByRoleQuery::class,

                'purchaseRequest' => App\GraphQL\Query\PurchaseRequestQuery::class,
                'purchaseRequests' => App\GraphQL\Query\PurchasePaginationQuery::class,
                'purchaseRequestss' => App\GraphQL\Query\PurchaseRequestsQuery::class,

                'searchPayment' => App\GraphQL\Query\SearchPaymentQuery::class,
                'searchPaymentList' => App\GraphQL\Query\SearchPaymentListQuery::class,
                'countryStates' => App\GraphQL\Query\CountryStatesQuery::class,
                'purchaseRequestPayment' => App\GraphQL\Query\PurchaseRequestPaymentQuery::class,
                'categorys' => App\GraphQL\Query\CategorysQuery::class,
                'providers' => App\GraphQL\Query\ProvidersQuery::class,
                'hotels'    => App\GraphQL\Query\HotelsQuery::class,
                'activeEvents'    => App\GraphQL\Query\ActiveEventsQuery::class,
                'accessesByEvent'  => App\GraphQL\Query\AccessesByEventQuery::class,
                'providerByEvent'  => App\GraphQL\Query\ProviderByEventQuery::class,

                'zone'  => App\GraphQL\Query\ZoneQuery::class,

                'accessByEvent'  => App\GraphQL\Query\AccessByEventQuery::class,

                'roomByHotelQuery'  => App\GraphQL\Query\RoomByHotelQuery::class,
                'rooms'  => App\GraphQL\Query\RoomsPaginationQuery::class,
                'roomsById' => App\GraphQL\Query\RoomById::class,

                'reservationAutocomplete'  => App\GraphQL\Query\ReservationAutocompleteQuery::class,

                'purchaseRequestAutocomplete'  => App\GraphQL\Query\PurchaseRequestAutocompleteQuery::class,

                'reservations'  => App\GraphQL\Query\ReservationPaginationQuery::class,

                'accessByEvents'  => App\GraphQL\Query\AccessByEventsQuery::class,

                'reservationPayment'  => App\GraphQL\Query\ReservationPaymentQuery::class,

                'searchPaymentReservation'  => App\GraphQL\Query\SearchPaymentReservationQuery::class,

                'hotelss' => App\GraphQL\Query\HotelsPaginationQuery::class,

                'hotelById' => App\GraphQL\Query\HotelsByIdQuery::class,

                'paidSalesList' => App\GraphQL\Query\PaidSalesListPaginationQuery::class,

                'sendEmail' => App\GraphQL\Query\SendEmailQuery::class,

                'reservationId'  => App\GraphQL\Query\ReservationIdQuery::class,

                'paidReservationsList' => App\GraphQL\Query\PaidReservationsListPaginationQuery::class,

                'sendEmailReservation' => App\GraphQL\Query\SendEmailReservationQuery::class,

                'purchaseAccessByEventGeneral' => App\GraphQL\Query\PurchaseAccessByEventGeneralQuery::class,
                'purchaseAccessByEventVip' => App\GraphQL\Query\PurchaseAccessByEventVipQuery::class,

                'accessByEventStatusVip' => App\GraphQL\Query\AccessByEventStatusVipQuery::class,
                'accessByEventStatusGeneral' => App\GraphQL\Query\AccessByEventStatusGeneralQuery::class,
                'accessByEventStatusBoxOffice' => App\GraphQL\Query\AccessByEventStatusBoxOfficeQuery::class,
                'accessByEventStatusPresale' => App\GraphQL\Query\AccessByEventStatusPresaleQuery::class,
                'accessByEventStatusTable' => App\GraphQL\Query\AccessByEventStatusTableQuery::class,

                'providersPagination' => App\GraphQL\Query\ProvidersPaginationQuery::class,

                'movementId' => App\GraphQL\Query\MovementQuery::class,
                'expensesMovementPagination' => App\GraphQL\Query\ExpensesMovementPaginationQuery::class,
                'incomeMovementPagination' => App\GraphQL\Query\IncomeMovementPaginationQuery::class,

                'providerId' => App\GraphQL\Query\ProviderIdQuery::class,

                'searchExpenses' => App\GraphQL\Query\SearchExpensesQuery::class,
                'searchIncome' => App\GraphQL\Query\SearchIncomeQuery::class,

                'boxOfficeSalesPagination' => App\GraphQL\Query\BoxOfficeSalesPaginationQuery::class,

                'salesTypeTablesPagination' => App\GraphQL\Query\SalesTypeTablesPaginationQuery::class,

                'presaleTypeSalesPagination' => App\GraphQL\Query\PresaleTypeSalesPaginationQuery::class,

                'searchAccessByEventStatusBoxOffice' => App\GraphQL\Query\SearchAccessByEventStatusBoxOfficeQuery::class,
                'searchAccessByEventStatusTable' => App\GraphQL\Query\SearchAccessByEventStatusTableQuery::class,

                'searchAccessByEventStatusPresale' => App\GraphQL\Query\SearchAccessByEventStatusPresaleQuery::class,

                'searchAccessByEventStatusPresale' => App\GraphQL\Query\SearchAccessByEventStatusPresaleQuery::class,

                'searchAccessByEventStatusTable' => App\GraphQL\Query\SearchAccessByEventStatusTableQuery::class,

                'listUsersDifferentAccesses' => App\GraphQL\Query\ListUsersDifferentAccessesQuery::class,

                'currencyById' => App\GraphQL\Query\CurrencyByIdQuery::class,
                'rateById' => App\GraphQL\Query\RateByIdQuery::class,

                'currencyPagination' => App\GraphQL\Query\CurrencyPaginationQuery::class,
                'ratePagination' => App\GraphQL\Query\RatePaginationQuery::class,

                'ratess' => App\GraphQL\Query\RatessQuery::class,

                'currencys' => App\GraphQL\Query\CurrencysQuery::class,

                'accountsByCurrency' => App\GraphQL\Query\AccountsByCurrencyQuery::class,

                'currencyHasEventPagination' => App\GraphQL\Query\CurrencyHasEventPaginationQuery::class,
                'currencyHasEventById' => App\GraphQL\Query\CurrencyHasEventByIdQuery::class,

                'bankAccountMovement' => App\GraphQL\Query\BankAccountMovementQuery::class,

                'searchBankAccountMovement' => App\GraphQL\Query\SearchBankAccountMovementQuery::class,

                'searchPaidSalesList' => App\GraphQL\Query\SearchPaidSalesListQuery::class,

                'searchPagedUsersFilter' => App\GraphQL\Query\SearchPagedUsersFilterQuery::class,

                'productPagination' => App\GraphQL\Query\ProductPaginationQuery::class,
                'categoryPagination' => App\GraphQL\Query\CategoryPaginationQuery::class,

                'budgetByEvent' => App\GraphQL\Query\BudgetByEventQuery::class,

                'products' => App\GraphQL\Query\ProductsQuery::class,

                'budgetById' => App\GraphQL\Query\BudgetByIdQuery::class,

                'categoryById' => App\GraphQL\Query\CategoryByIdQuery::class,

                'productById' => App\GraphQL\Query\ProductByIdQuery::class,


                'presentationPagination' => App\GraphQL\Query\PresentationPaginationQuery::class,
                'unitMeasurePagination' => App\GraphQL\Query\UnitMeasurePaginationQuery::class,
                'storageUnitPagination' => App\GraphQL\Query\StorageUnitPaginationQuery::class,
                'consumablePagination' => App\GraphQL\Query\ConsumablePaginationQuery::class,
                'servicePagination' => App\GraphQL\Query\ServicePaginationQuery::class,
                'serviceItemPagination' => App\GraphQL\Query\ServiceItemPaginationQuery::class,
                'depositPagination' => App\GraphQL\Query\DepositPaginationQuery::class,
                'depositProductPagination' => App\GraphQL\Query\DepositProductPaginationQuery::class,
                'barPagination' => App\GraphQL\Query\BarPaginationQuery::class,
                'depositBarEventPagination' => App\GraphQL\Query\DepositBarEventPaginationQuery::class,


                'depositMovementPagination' => App\GraphQL\Query\DepositMovementPaginationQuery::class,

                'salePagination' => App\GraphQL\Query\SalePaginationQuery::class,
                'saleItemPagination' => App\GraphQL\Query\SaleItemPaginationQuery::class,
                'specialDiscountPagination' => App\GraphQL\Query\SpecialDiscountPaginationQuery::class,


                'presentationById' => App\GraphQL\Query\PresentationByIdQuery::class,
                'unitMeasureById' => App\GraphQL\Query\UnitMeasureByIdQuery::class,
                'storageUnitById' => App\GraphQL\Query\StorageUnitByIdQuery::class,
                'consumableById' => App\GraphQL\Query\ConsumableByIdQuery::class,
                'serviceById' => App\GraphQL\Query\ServiceByIdQuery::class,
                'serviceItemById' => App\GraphQL\Query\ServiceItemByIdQuery::class,
                'depositById' => App\GraphQL\Query\DepositByIdQuery::class,
                'depositProductById' => App\GraphQL\Query\DepositProductByIdQuery::class,
                'barById' => App\GraphQL\Query\BarByIdQuery::class,
                'depositBarEventById' => App\GraphQL\Query\DepositBarEventByIdQuery::class,
                'depositMovementById' => App\GraphQL\Query\DepositMovementByIdQuery::class,
                'saleById' => App\GraphQL\Query\SaleByIdQuery::class,
                'saleItemById' => App\GraphQL\Query\SaleItemByIdQuery::class,
                'specialDiscountById' => App\GraphQL\Query\SpecialDiscountByIdQuery::class,*/

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


               /* 'createToken' => App\GraphQL\Mutation\Auth\CreateTokenMutation::class,
                'refreshToken' => App\GraphQL\Mutation\Auth\RefreshTokenMutation::class,

                'createUser' => App\GraphQL\Mutation\User\CreateUserMutation::class,
                'deleteUser' => App\GraphQL\Mutation\User\DeleteUserMutation::class,
                'updateUser' => App\GraphQL\Mutation\User\UpdateUserMutation::class,
                'updateEmailUser' => App\GraphQL\Mutation\User\UpdateEmailMutation::class,
                'resetPasswordUser' => App\GraphQL\Mutation\User\ResetPasswordMutation::class,
                'resetPasswordIdUser' => App\GraphQL\Mutation\User\ResetPasswordIdMutation::class,
                'blockedUser' => App\GraphQL\Mutation\User\BlockedUserMutation::class,

                'createRole' => App\GraphQL\Mutation\Role\CreateRoleMutation::class,
                'deleteRole' => App\GraphQL\Mutation\Role\DeleteRoleMutation::class,
                'updateRole' => App\GraphQL\Mutation\Role\UpdateRoleMutation::class,
                'blockedRole' => App\GraphQL\Mutation\Role\BlockedRoleMutation::class,

                'createLocation' => App\GraphQL\Mutation\Location\CreateLocationMutation::class,
                'deleteLocation' => App\GraphQL\Mutation\Location\DeleteLocationMutation::class,
                'updateLocation' => App\GraphQL\Mutation\Location\UpdateLocationMutation::class,
                'blockedLocation' => App\GraphQL\Mutation\Location\BlockedLocationMutation::class,

                'createEvent' => App\GraphQL\Mutation\Event\CreateEventMutation::class,
                'deleteEvent' => App\GraphQL\Mutation\Event\DeleteEventMutation::class,
                'updateEvent' => App\GraphQL\Mutation\Event\UpdateEventMutation::class,
                'blockedEvent' => App\GraphQL\Mutation\Event\BlockedEventMutation::class,

                'createAccess' => App\GraphQL\Mutation\Access\CreateAccessMutation::class,
                'deleteAccess' => App\GraphQL\Mutation\Access\DeleteAccessMutation::class,
                'updateAccess' => App\GraphQL\Mutation\Access\UpdateAccessMutation::class,
                'blockedAccess' => App\GraphQL\Mutation\Access\BlockedAccessMutation::class,

                'createBank' => App\GraphQL\Mutation\Bank\CreateBankMutation::class,
                'deleteBank' => App\GraphQL\Mutation\Bank\DeleteBankMutation::class,
                'updateBank' => App\GraphQL\Mutation\Bank\UpdateBankMutation::class,

                'createBankAccount' => App\GraphQL\Mutation\BankAccount\CreateBankAccountMutation::class,
                'deleteBankAccount' => App\GraphQL\Mutation\BankAccount\DeleteBankAccountMutation::class,
                'updateBankAccount' => App\GraphQL\Mutation\BankAccount\UpdateBankAccountMutation::class,

                'createInvited' => App\GraphQL\Mutation\Invited\CreateInvitedMutation::class,
                'deleteInvited' => App\GraphQL\Mutation\Invited\DeleteInvitedMutation::class,
                'updateInvited' => App\GraphQL\Mutation\Invited\UpdateInvitedMutation::class,

                'createPayment' => App\GraphQL\Mutation\Payment\CreatePaymentMutation::class,
                'deletePayment' => App\GraphQL\Mutation\Payment\DeletePaymentMutation::class,
                'updatePayment' => App\GraphQL\Mutation\Payment\UpdatePaymentMutation::class,

                'createPurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\CreatePurchaseRequestMutation::class,
                'deletePurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\DeletePurchaseRequestMutation::class,
                'updatePurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\UpdatePurchaseRequestMutation::class,
                'statePurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\StatePurchaseRequestMutation::class,
                'stateRefundPurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\StateRefundPurchaseRequestMutation::class,

                'updateUserPurchaseRequest' => App\GraphQL\Mutation\PurchaseRequest\UpdateUserPurchaseRequestMutation::class,

                'createZone' => App\GraphQL\Mutation\Zone\CreateZoneMutation::class,
                'deleteZone' => App\GraphQL\Mutation\Zone\DeleteZoneMutation::class,
                'updateZone' => App\GraphQL\Mutation\Zone\UpdateZoneMutation::class,
                'blockedZone' => App\GraphQL\Mutation\Zone\BlockedZoneMutation::class,

                'createProduct' => App\GraphQL\Mutation\Product\CreateProductMutation::class,
                'deleteProduct' => App\GraphQL\Mutation\Product\DeleteProductMutation::class,
                'updateProduct' => App\GraphQL\Mutation\Product\UpdateProductMutation::class,

                'createCategory' => App\GraphQL\Mutation\Category\CreateCategoryMutation::class,
                'deleteCategory' => App\GraphQL\Mutation\Category\DeleteCategoryMutation::class,
                'updateCategory' => App\GraphQL\Mutation\Category\UpdateCategoryMutation::class,

                'createProvider' => App\GraphQL\Mutation\Provider\CreateProviderMutation::class,
                'deleteProvider' => App\GraphQL\Mutation\Provider\DeleteProviderMutation::class,
                'updateProvider' => App\GraphQL\Mutation\Provider\UpdateProviderMutation::class,
                'blockedProvider' => App\GraphQL\Mutation\Provider\BlockedProviderMutation::class,


                'createBudget' => App\GraphQL\Mutation\Budget\CreateBudgetMutation::class,
                'blockedBudget' => App\GraphQL\Mutation\Budget\BlockedBudgetMutation::class,
                'deleteBudget' => App\GraphQL\Mutation\Budget\DeleteBudgetMutation::class,
                'statusBudget' => App\GraphQL\Mutation\Budget\StatusBudgetMutation::class,
                'updateBudget' => App\GraphQL\Mutation\Budget\UpdateBudgetMutation::class,
                'addBudgetProducts' => App\GraphQL\Mutation\Budget\AddBudgetProductsMutation::class,

                'createAccessesByEvent' => App\GraphQL\Mutation\AccessesByEvent\CreateAccessesByEventMutation::class,
                'deleteAccessesByEvent' => App\GraphQL\Mutation\AccessesByEvent\DeleteAccessesByEventMutation::class,
                'updateAccessesByEvent' => App\GraphQL\Mutation\AccessesByEvent\UpdateAccessesByEventMutation::class,
                'blockedAccessesByEvent' => App\GraphQL\Mutation\AccessesByEvent\BlockedAccessesByEventMutation::class,

                'createHotel' => App\GraphQL\Mutation\Hotel\CreateHotelMutation::class,
                'deleteHotel' => App\GraphQL\Mutation\Hotel\DeleteHotelMutation::class,
                'updateHotel' => App\GraphQL\Mutation\Hotel\UpdateHotelMutation::class,
                'blockedHotel' => App\GraphQL\Mutation\Hotel\BlockedHotelMutation::class,

                'createRoom' => App\GraphQL\Mutation\Room\CreateRoomMutation::class,
                'deleteRoom' => App\GraphQL\Mutation\Room\DeleteRoomMutation::class,
                'updateRoom' => App\GraphQL\Mutation\Room\UpdateRoomMutation::class,
                'blockedRoom' => App\GraphQL\Mutation\Room\BlockedRoomMutation::class,

                'createReservation' => App\GraphQL\Mutation\Reservation\CreateReservationMutation::class,
                'deleteReservation' => App\GraphQL\Mutation\Reservation\DeleteReservationMutation::class,
                'updateReservation' => App\GraphQL\Mutation\Reservation\UpdateReservationMutation::class,

                'createPaymentReservation' => App\GraphQL\Mutation\PaymentReservation\CreatePaymentReservationMutation::class,
                'deletePaymentReservation' => App\GraphQL\Mutation\PaymentReservation\DeletePaymentReservationMutation::class,
                'updatePaymentReservation' => App\GraphQL\Mutation\PaymentReservation\UpdatePaymentReservationMutation::class,

                'NewCreateInvited' => App\GraphQL\Mutation\Invited\NewCreateInvitedMutation::class,
                'NewCreateUser' => App\GraphQL\Mutation\Invited\NewCreateUserMutation::class,

                'createMovement' => App\GraphQL\Mutation\Movement\CreateMovementMutation::class,
                'deleteMovement' => App\GraphQL\Mutation\Movement\DeleteMovementMutation::class,
                'updateMovement' => App\GraphQL\Mutation\Movement\UpdateMovementMutation::class,
                'blockedMovement' => App\GraphQL\Mutation\Movement\BlockedMovementMutation::class,

                'createRate' => App\GraphQL\Mutation\Rate\CreateRateMutation::class,
                'deleteRate' => App\GraphQL\Mutation\Rate\DeleteRateMutation::class,
                'updateRate' => App\GraphQL\Mutation\Rate\UpdateRateMutation::class,
                'blockedRate' => App\GraphQL\Mutation\Rate\BlockedRateMutation::class,

                'createCurrency' => App\GraphQL\Mutation\Currency\CreateCurrencyMutation::class,
                'deleteCurrency' => App\GraphQL\Mutation\Currency\DeleteCurrencyMutation::class,
                'updateCurrency' => App\GraphQL\Mutation\Currency\UpdateCurrencyMutation::class,
                'blockedCurrency' => App\GraphQL\Mutation\Currency\BlockedCurrencyMutation::class,

                'createCurrencyHasEvent' => App\GraphQL\Mutation\CurrencyHasEvent\CreateCurrencyHasEventMutation::class,
                'deleteCurrencyHasEvent' => App\GraphQL\Mutation\CurrencyHasEvent\DeleteCurrencyHasEventMutation::class,
                'updateCurrencyHasEvent' => App\GraphQL\Mutation\CurrencyHasEvent\UpdateCurrencyHasEventMutation::class,
                'blockedCurrencyHasEvent' => App\GraphQL\Mutation\CurrencyHasEvent\BlockedCurrencyHasEventMutation::class,


                'createPaymentBudget' => App\GraphQL\Mutation\PaymentBudget\CreatePaymentBudgetMutation::class,
                'deletePaymentBudget' => App\GraphQL\Mutation\PaymentBudget\DeletePaymentBudgetMutation::class,
                'updatePaymentBudget' => App\GraphQL\Mutation\PaymentBudget\UpdatePaymentBudgetMutation::class,

                'createPresentation' => App\GraphQL\Mutation\Presentation\CreatePresentationMutation::class,
                'deletePresentation' => App\GraphQL\Mutation\Presentation\DeletePresentationMutation::class,
                'updatePresentation' => App\GraphQL\Mutation\Presentation\UpdatePresentationMutation::class,

                'createUnitMeasure' => App\GraphQL\Mutation\UnitMeasure\CreateUnitMeasureMutation::class,
                'deleteUnitMeasure' => App\GraphQL\Mutation\UnitMeasure\DeleteUnitMeasureMutation::class,
                'updateUnitMeasure' => App\GraphQL\Mutation\UnitMeasure\UpdateUnitMeasureMutation::class,

                'createStorageUnit' => App\GraphQL\Mutation\StorageUnit\CreateStorageUnitMutation::class,
                'deleteStorageUnit' => App\GraphQL\Mutation\StorageUnit\DeleteStorageUnitMutation::class,
                'updateStorageUnit' => App\GraphQL\Mutation\StorageUnit\UpdateStorageUnitMutation::class,

                'createService' => App\GraphQL\Mutation\Service\CreateServiceMutation::class,
                'deleteService' => App\GraphQL\Mutation\Service\DeleteServiceMutation::class,
                'updateService' => App\GraphQL\Mutation\Service\UpdateServiceMutation::class,
                'blockedService' => App\GraphQL\Mutation\Service\BlockedServiceMutation::class,

                'createConsumable' => App\GraphQL\Mutation\Consumable\CreateConsumableMutation::class,
                'deleteConsumable' => App\GraphQL\Mutation\Consumable\DeleteConsumableMutation::class,
                'updateConsumable' => App\GraphQL\Mutation\Consumable\UpdateConsumableMutation::class,
                'blockedConsumable' => App\GraphQL\Mutation\Consumable\BlockedConsumableMutation::class,

                'createDeposit' => App\GraphQL\Mutation\Deposit\CreateDepositMutation::class,
                'deleteDeposit' => App\GraphQL\Mutation\Deposit\DeleteDepositMutation::class,
                'updateDeposit' => App\GraphQL\Mutation\Deposit\UpdateDepositMutation::class,

                'createServiceItem' => App\GraphQL\Mutation\ServiceItem\CreateServiceItemMutation::class,
                'deleteServiceItem' => App\GraphQL\Mutation\ServiceItem\DeleteServiceItemMutation::class,
                'updateServiceItem' => App\GraphQL\Mutation\ServiceItem\UpdateServiceItemMutation::class,

                'createDepositBarEvent' => App\GraphQL\Mutation\DepositBarEvent\CreateDepositBarEventMutation::class,
                'deleteDepositBarEvent' => App\GraphQL\Mutation\DepositBarEvent\DeleteDepositBarEventMutation::class,
                'updateDepositBarEvent' => App\GraphQL\Mutation\DepositBarEvent\UpdateDepositBarEventMutation::class,

                'createBar' => App\GraphQL\Mutation\Bar\CreateBarMutation::class,
                'deleteBar' => App\GraphQL\Mutation\Bar\DeleteBarMutation::class,
                'updateBar' => App\GraphQL\Mutation\Bar\UpdateBarMutation::class,

                'createDepositProduct' => App\GraphQL\Mutation\DepositProduct\CreateDepositProductMutation::class,
                'deleteDepositProduct' => App\GraphQL\Mutation\DepositProduct\DeleteDepositProductMutation::class,
                'updateDepositProduct' => App\GraphQL\Mutation\DepositProduct\UpdateDepositProductMutation::class,

                'createDepositMovement' => App\GraphQL\Mutation\DepositMovement\CreateDepositMovementMutation::class,
                'deleteDepositMovement' => App\GraphQL\Mutation\DepositMovement\DeleteDepositMovementMutation::class,
                'updateDepositMovement' => App\GraphQL\Mutation\DepositMovement\UpdateDepositMovementMutation::class,

                'createSale' => App\GraphQL\Mutation\Sale\CreateSaleMutation::class,
                'deleteSale' => App\GraphQL\Mutation\Sale\DeleteSaleMutation::class,
                'updateSale' => App\GraphQL\Mutation\Sale\UpdateSaleMutation::class,*/


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
