<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsSeerder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();


        DB::unprepared("TRUNCATE permissions;");
        Schema::enableForeignKeyConstraints();


        DB::table('permissions')->insert(array(

            array(
                'name' => '/',
                'display_name' => 'main-page',
                'guard_name' => 'web',
                'routes' => '/',
                'category' => 'main page',
                'created_at' => null,
                'updated_at' => null,


            ),

            array(
                'name' => 'quotes.index',
                'display_name' => 'quote list',
                'guard_name' => 'web',
                'routes' => 'quotes.index,quotes.show',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'quotes.create',
                'display_name' => 'quote create',
                'guard_name' => 'web',
                'routes' => 'quotes.create,quotes.store,',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'quotes.edit',
                'display_name' => 'quote edit',
                'guard_name' => 'web',
                'routes' => 'quotes.edit,quotes.update,',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'quotes.delete',
                'display_name' => 'quote delete',
                'guard_name' => 'web',
                'routes' => 'quotes.destroy',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'quotes.pdf',
                'display_name' => 'quote pdf',
                'guard_name' => 'web',
                'routes' => 'admin.quotes.pdf',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'quotes.excel',
                'display_name' => 'quote excel',
                'guard_name' => 'web',
                'routes' => 'admin.quotes.excel',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),
            array(
                'name' => 'quotes.convert-to-invoice',
                'display_name' => 'quotes convert-to-invoice',
                'guard_name' => 'web',
                'routes' => 'quotes.convert-to-invoice',
                'category' => 'quotes',
                'created_at' => null,
                'updated_at' => null,

            ),


            array(
                'name' => 'invoices.index',
                'display_name' => 'invoice list',
                'guard_name' => 'web',
                'routes' => 'invoices.index,invoices.show',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'invoices.create',
                'display_name' => 'invoice create',
                'guard_name' => 'web',
                'routes' => 'invoices.create,invoices.store,',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'invoices.edit',
                'display_name' => 'invoice edit',
                'guard_name' => 'web',
                'routes' => 'invoices.edit,invoices.update,',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'invoices.delete',
                'display_name' => 'invoice delete',
                'guard_name' => 'web',
                'routes' => 'invoices.destroy',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'invoices.pdf',
                'display_name' => 'invoice pdf',
                'guard_name' => 'web',
                'routes' => 'admin.invoices.pdf',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),

            array(
                'name' => 'invoices.excel',
                'display_name' => 'invoice excel',
                'guard_name' => 'web',
                'routes' => 'admin.invoices.excel',
                'category' => 'invoices',
                'created_at' => null,
                'updated_at' => null,

            ),
            array(
                'name' => 'clients.index',
                'display_name' => 'clients list',
                'guard_name' => 'web',
                'routes' => 'clients.index,clients.show',
                'category' => 'clients',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'clients.create',
                'display_name' => 'clients create',
                'guard_name' => 'web',
                'routes' => 'clients.create,clients.store',
                'category' => 'clients',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'clients.edit',
                'display_name' => 'clients edit',
                'guard_name' => 'web',
                'routes' => 'clients.edit,clients.update',
                'category' => 'clients',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'clients.destroy',
                'display_name' => 'clients delete',
                'guard_name' => 'web',
                'routes' => 'clients.destroy',
                'category' => 'clients',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'settings.edit',
                'display_name' => 'settings',
                'guard_name' => 'web',
                'routes' => 'settings.edit',
                'category' => 'settings',
                'created_at' => null,
                'updated_at' => null,
            ),

            array(
                'name' => 'payments.index',
                'display_name' => 'payments list',
                'guard_name' => 'web',
                'routes' => 'payments.index,payments.show',
                'category' => 'payments',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'payments.create',
                'display_name' => 'payments create',
                'guard_name' => 'web',
                'routes' => 'payments.create,payments.store',
                'category' => 'payments',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'payments.edit',
                'display_name' => 'payments edit',
                'guard_name' => 'web',
                'routes' => 'payments.edit,payments.update',
                'category' => 'payments',
                'created_at' => null,
                'updated_at' => null,
            ),
            array(
                'name' => 'payments.destroy',
                'display_name' => 'payments delete',
                'guard_name' => 'web',
                'routes' => 'payments.destroy',
                'category' => 'payments',
                'created_at' => null,
                'updated_at' => null,
            ),

            array(
                'name' => 'payments.excel',
                'display_name' => 'payments excel',
                'guard_name' => 'web',
                'routes' => 'admin.paymentsExcel',
                'category' => 'payments',
                'created_at' => null,
                'updated_at' => null,

            ),
        ));

        Artisan::call('optimize:clear');
    }
}
