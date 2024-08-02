<?php

namespace Nhrrob\Movies\Database;

abstract class Migration
{
    abstract public function up();
    abstract public function down();
}