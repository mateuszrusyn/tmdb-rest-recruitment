# TMDB Rest Recruitment

## Basic configuration

Run migrations: 

``
php artisan migrate
``

Set TMDB API key in .env file:

``
TMDB_API_KEY=XXXXXXXXXX
``


Run TMDB fetch command:

``
php artisan app:fetch-tmdb-data
``

## Movies endpoint

```http
GET /{lang}/movies
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `lang` | `string` | Language (EN, PL, DE) |

## Series endpoint

```http
GET /{lang}/series
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `lang` | `string` | Language (EN, PL, DE) |

## Movie genres endpoint

```http
GET /{lang}/movie/genres
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `lang` | `string` | Language (EN, PL, DE) |

## Serie genres endpoint

```http
GET /{lang}/serie/genres
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `lang` | `string` | Language (EN, PL, DE) |
