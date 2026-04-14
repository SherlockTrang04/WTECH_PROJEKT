<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
              CREATE OR REPLACE FUNCTION products_search_vector_update() RETURNS trigger AS \$\$
              BEGIN
                  NEW.search_vector := to_tsvector('english',
                      coalesce(NEW.name, '') || ' ' ||
                      coalesce(NEW.description, '') || ' ' ||
                      coalesce(NEW.brand, '')
                  );
                  RETURN NEW;
              END;
              \$\$ LANGUAGE plpgsql;

              CREATE TRIGGER products_search_vector_trigger
              BEFORE INSERT OR UPDATE ON products
              FOR EACH ROW EXECUTE FUNCTION products_search_vector_update();
          ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
              DROP TRIGGER IF EXISTS products_search_vector_trigger ON products;
              DROP FUNCTION IF EXISTS products_search_vector_update;
          ");
    }
};
