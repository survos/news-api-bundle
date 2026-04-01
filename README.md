# NewsApiBundle

A Symfony bundle to interact with NewsApiCDN via the [NewsApi-PHP library](https://github.com/jcobhams/newsapi-php).

Still under development, feedback welcome!  

## Quickstart
```bash
symfony new news-api-demo --webapp && cd news-api-demo
composer require survos/news-api-bundle
```


## Installation

Go to https://newsapi.com and get a key.

Create a new Symfony project.

```bash
symfony new news-api-demo --webapp && cd news-api-demo
composer require survos/news-api-bundle
bin/console news-api:list
```

You can browse interactively with the basic admin controller.

```bash
composer require survos/simple-datatables-bundle
symfony server:start -d
symfony open:local --path=/news-api/
```

Or edit .env.local and add your API key.


```bash
bin/console news-api:list 
```

```bash
+------------- museado/ -----+--------+
| ObjectName     | Path      | Length |
+----------------+-----------+--------+
| photos finales | /museado/ | 0      |
+----------------+-----------+--------+


```

