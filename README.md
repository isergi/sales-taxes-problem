A simple tool that prints out the receipt details
============================================================

## Requirements

  - PHP 7.1+
  - [PHP Composer](https://getcomposer.org/)

## Installation and Usage

To install the dependencies run:
```bash
composer install
```

The Sales Taxes tool works without database storage and for taxes rates the tool uses a configuration. You can change taxes params in the [./config/taxes.config.json](https://github.com/isergi/sales-taxes-problem/blob/master/config/taxes.config.json) config file.
```bash
{
    "default" : {
        "rate" : 10,
        "exclude" : [
            "books",
            "food",
            "medical"
        ]
    },
    "imported" : {
        "rate"  : 5
    }
}
```

Demo input data keeps in the [./data/](https://github.com/isergi/sales-taxes-problem/tree/master/data) dirrectory. You can use this example CSV files to apply yours sets of products.
```bash
2;book;12.49
1;music CD;14.99
1;chocolate bar;0.85
```

### Run Tool

To get usage information run:
```bash
./sales-taxes-tool --help
```
Usage examples:
```bash
# Print out a new receipt information from `input1.csv` set of products
./sales-taxes-tool -i data/input1.csv

# Print out a new receipt information from `input2.csv` set of products
./sales-taxes-tool -i data/input1.csv

# Print out a new receipt information from `input3.csv` set of products
./sales-taxes-tool -i data/input1.csv
```

## Testing

### Unit Tests

Use PHPUnit to run all sales taxes tools tests:
```bash
composer test

PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

.......                                                             7 / 7 (100%)

Time: 28 ms, Memory: 4.00MB

OK (7 tests, 14 assertions)
```

# Troubleshooting

## Unable to Start Sales Taxes Tool

**Symptom**: 

Getting a "permission denied" message
```bash
$ ./sales-taxes-tool --help
permission denied: ./sales-taxes-tool
```

**Solution**:

Try to set **+x** permission to the **sales-taxes-tool**
```bash
$ chmod +x ./sales-taxes-tool
```

## Unable to Read Input File

**Symptom**: 

Getting an "unable to open" message
```bash
$ ./sales-taxes-tool -i data/input1.csv
ERROR: Unable to open file "./data/input1.csv" 
```

**Solution**:

Try to set **read** permission to the directory or an input file you are using for a new **receipt** printing out
```bash
$ chmod +r ./data/input1.csv
```