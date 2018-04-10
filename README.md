# PHP HCL Parser

HCL is a configuration language make by HashiCorp. HCL files are used by several HashiCorp products,
including Terraform.

This library parses HCL configuration files into PHP objects.

## Installation

You can install the PHP HCL Parser library using Composer. Just run the following command
from the root of your project.

```
composer require divineomega/php-hcl-parser
```

## Usage

To parse HCL into a PHP object, create a new `HCLParser` object passing a string of HCL configuration
as the first parameter of the construction, then call the `parse` method. See the example below.

```php
$hcl = '
# Specify the provider and access details
provider "aws" {
  access_key = "${var.access_key}"
  secret_key = "${var.secret_key}"
  region     = "${var.region}"
}

# Create an instance
resource "aws_instance" "example" {
  ami           = "ami-2757f631"
  instance_type = "t2.micro"
}

';

$configObject = (new HCLParser($hcl))->parse();
```

The resulting object will be returned in the following format.

```php
object(stdClass)#5 (2) {
  ["provider"]=>
  array(1) {
    [0]=>
    object(stdClass)#4 (1) {
      ["aws"]=>
      array(1) {
        [0]=>
        object(stdClass)#2 (3) {
          ["access_key"]=>
          string(17) "${var.access_key}"
          ["region"]=>
          string(13) "${var.region}"
          ["secret_key"]=>
          string(17) "${var.secret_key}"
        }
      }
    }
  }
  ["resource"]=>
  array(1) {
    [0]=>
    object(stdClass)#8 (1) {
      ["aws_instance"]=>
      array(1) {
        [0]=>
        object(stdClass)#7 (1) {
          ["example"]=>
          array(1) {
            [0]=>
            object(stdClass)#6 (2) {
              ["ami"]=>
              string(12) "ami-2757f631"
              ["instance_type"]=>
              string(8) "t2.micro"
            }
          }
        }
      }
    }
  }
}
```