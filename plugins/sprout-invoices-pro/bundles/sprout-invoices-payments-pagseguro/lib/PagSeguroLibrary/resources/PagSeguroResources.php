<?php
/**
 * 2007-2014 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 *  @author    PagSeguro Internet Ltda.
 *  @copyright 2007-2014 PagSeguro Internet Ltda.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */

// Base URLs
$PagSeguroResources['baseUrl']               = [];
$PagSeguroResources['baseUrl']['production'] = 'https://pagseguro.uol.com.br';
$PagSeguroResources['baseUrl']['sandbox']    = 'https://sandbox.pagseguro.uol.com.br';

// Static URLs
$PagSeguroResources['staticUrl']               = [];
$PagSeguroResources['staticUrl']['production'] = 'https://stc.pagseguro.uol.com.br';
$PagSeguroResources['staticUrl']['sandbox']    = 'https://stc.sandbox.pagseguro.uol.com.br';

// WebService URLs
$PagSeguroResources['webserviceUrl']               = [];
$PagSeguroResources['webserviceUrl']['production'] = 'https://ws.pagseguro.uol.com.br';
$PagSeguroResources['webserviceUrl']['sandbox']    = 'https://ws.sandbox.pagseguro.uol.com.br';

// Payment service
$PagSeguroResources['paymentService']                          = [];
$PagSeguroResources['paymentService']['servicePath']           = '/v2/checkout';
$PagSeguroResources['paymentService']['checkoutUrl']           = '/v2/checkout/payment.html';
$PagSeguroResources['paymentService']['baseUrl']['production'] = 'https://pagseguro.uol.com.br';
$PagSeguroResources['paymentService']['baseUrl']['sandbox']    = 'https://sandbox.pagseguro.uol.com.br';
$PagSeguroResources['paymentService']['serviceTimeout']        = 20;

// Session service
$PagSeguroResources['sessionService']        = [];
$PagSeguroResources['sessionService']['url'] = '/v2/sessions';

// Installment service
$PagSeguroResources['installmentService']        = [];
$PagSeguroResources['installmentService']['url'] = '/checkout/v2/installments.json';

// Direct payment service
$PagSeguroResources['directPaymentService']                   = [];
$PagSeguroResources['directPaymentService']['servicePath']    = '/v2/transactions';
$PagSeguroResources['directPaymentService']['checkoutUrl']    = '/v2/transactions';
$PagSeguroResources['directPaymentService']['serviceTimeout'] = 20;

// Notification service
$PagSeguroResources['notificationService']                   = [];
$PagSeguroResources['notificationService']['servicePath']    = '/v3/transactions/notifications';
$PagSeguroResources['notificationService']['serviceTimeout'] = 20;

// Transaction search service
$PagSeguroResources['transactionSearchService']                      = [];
$PagSeguroResources['transactionSearchService']['servicePath']['v2'] = '/v2/transactions';
$PagSeguroResources['transactionSearchService']['servicePath']['v3'] = '/v3/transactions';
$PagSeguroResources['transactionSearchService']['serviceTimeout']    = 20;
