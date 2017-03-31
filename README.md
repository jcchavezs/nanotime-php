# Nanotime PHP

A couple of value objects for representing nanotime.

## Usage

```php
    $nanotime = Nanotime::now();
    usleep(1);
    $nanotime2 = Nanotime::now();
    echo $nanotime2->diff($nanotime);
```

## Further development
This is just a wrapper for the Nanotime concept (which does not exist in PHP) that will perfectly work as an abstraction for nanotime in PHP projects.
Further development will tackle the problem about getting an accurate value for nanotime.