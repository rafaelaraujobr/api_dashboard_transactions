<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

![Dashboard 1](https://res.cloudinary.com/dp0qcuzkq/image/upload/v1701023559/t0ak5pmwnchvchis47hg.jpg)

## Instalaçao

1. Clone repository

    ```
    git clone https://github.com/rafaelaraujobr/api_dashboard_transactions
    ```

2. Change into the working directory

    ```
    cd api_dashboard_transactions
    ```

3. Copy `.env.example` to `.env` and modify according to your environment

    ```
    cp .env.example .env
    ```

4. Install composer dependencies

    ```
    composer install --prefer-dist
    ```

5. An application key can be generated with the command

    ```
    php artisan key:generate
    ```

6. Iniciar Docker composer

    ```
    docker compose -f "docker-compose.yml" up -d --build
    ```

9. Run these commands to create the tables within the defined database and populate seed data

    ```
    php artisan migrate --seed
    php artisan db:seed --class=TransactionSeeder

# Documentação da API REST

## Introdução

Bem-vindo à documentação da API REST para o serviço de widgets. Esta API fornece acesso aos dados de geolocalização de clientes.

## Endpoints

## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações dos Widgets do Dashboard. |
| `GET` | Retorna informações da lista de transações. |
| `GET` | Atualiza dados de um registro ou altera sua situação. |

### 1. Obter informacoes dos Widgets do Dashboard

**Endpoint:**
GET /widgets/{parametro}/dashboard
**Parâmetros:**

- `geolocation` (Obrigatório): Parâmetro para especificar a geolocalização.
- `min_max` (Obrigatório): Parâmetro para especificar a transaction minima e maxima.
- `revenue` (Obrigatório): Parâmetro para especificar o valor da soma total das transaction com status pago .
- `quantity` (Obrigatório): Parâmetro para especificar o soma total das quantidades das transações.
- `transactions` (Obrigatório): Parâmetro para especificar quantidades de registros de transações.
- `region` (Obrigatório): Parâmetro para especificar quantidades de registros de transações por estado.
- `gender` (Obrigatório): Parâmetro para especificar quantidades de registros de transações por genero.
- `payment_method` (Obrigatório): Parâmetro para especificar quantidades de registros de transações por metodos de pagamento.
- `payment_status` (Obrigatório): Parâmetro para especificar quantidades de registros de transações por estatus de pagamento.

**Códigos de Resposta:**
- 200 OK: A solicitação foi bem-sucedida.
- 400 Bad Request: Parâmetros ausentes ou inválidos.
- 404 Not Found: Recurso não encontrado.

**Exemplo de Requisição:**
GET /widgets/geolocation/dashboard
**Exemplo de Resposta:**

+ Response 200 (application/json)
[
	{
		"client": "Fontes S.A.",
		"lat": -31.384982,
		"long": -71.073455
	},
	{
		"client": "Maia-Soares",
		"lat": -27.018904,
		"long": -58.061755
	},
	{
		"client": "Pedrosa S.A.",
		"lat": -27.295675,
		"long": -55.130655
	},
	{
		"client": "Amaral Comercial Ltda.",
		"lat": -5.927239,
		"long": -41.781814
	}
]

**Exemplo de Requisição:**
http://localhost:8000/widgets/min_max/dashboard
**Exemplo de Resposta:**

+ Response 200 (application/json)
{
	"max": "999.30",
	"min": "80.20"
}

### 1. Obter informacoes das lista de informacoes

**Endpoint:**
GET /transactions?query
**Query Parâmetros:**

**Códigos de Resposta:**
- 200 OK: A solicitação foi bem-sucedida.
- 400 Bad Request: Parâmetros ausentes ou inválidos.
- 404 Not Found: Recurso não encontrado.

**Exemplo de Requisição:**
http://localhost:8000/transactions/
**Exemplo de Resposta:**

+ Response 200 (application/json)
{
	"data": [
		{
			"id": 1872,
			"client": "Faro e Leon",
			"price": "85.73",
			"quantity": 3,
			"device": "tablet",
			"status": "refunded",
			"created_at": "2023-10-26 17:55:00",
			"updated_at": "2023-11-10 06:37:54"
		},
		{
			"id": 560,
			"client": "Padilha Comercial Ltda.",
			"price": "109.29",
			"quantity": 4,
			"device": "mobile",
			"status": "pending",
			"created_at": "2023-10-26 19:28:11",
			"updated_at": "2023-11-07 02:51:20"
		},
		{
			"id": 1271,
			"client": "Marés-Maldonado",
			"price": "236.33",
			"quantity": 3,
			"device": "mobile",
			"status": "declined",
			"created_at": "2023-10-26 20:51:55",
			"updated_at": "2023-11-11 08:46:17"
		},
		{
			"id": 1546,
			"client": "Molina Comercial Ltda.",
			"price": "141.36",
			"quantity": 1,
			"device": "mobile",
			"status": "refunded",
			"created_at": "2023-10-26 21:34:22",
			"updated_at": "2023-10-27 12:29:43"
		},
		{
			"id": 729,
			"client": "Marques Comercial Ltda.",
			"price": "556.65",
			"quantity": 1,
			"device": "mobile",
			"status": "canceled",
			"created_at": "2023-10-26 21:42:14",
			"updated_at": "2023-11-14 12:16:12"
		},
		{
			"id": 1248,
			"client": "Guerra e Filhos",
			"price": "838.48",
			"quantity": 5,
			"device": "mobile",
			"status": "canceled",
			"created_at": "2023-10-26 22:28:49",
			"updated_at": "2023-11-19 02:02:30"
		},
		{
			"id": 1923,
			"client": "Aranda e Dominato S.A.",
			"price": "987.57",
			"quantity": 3,
			"device": "desktop",
			"status": "paid",
			"created_at": "2023-10-26 22:54:14",
			"updated_at": "2023-11-18 13:48:55"
		},
		{
			"id": 1922,
			"client": "Valentin e Padilha",
			"price": "587.62",
			"quantity": 1,
			"device": "mobile",
			"status": "paid",
			"created_at": "2023-10-26 23:55:30",
			"updated_at": "2023-11-05 19:34:29"
		},
		{
			"id": 13,
			"client": "Verdugo Comercial Ltda.",
			"price": "635.08",
			"quantity": 2,
			"device": "mobile",
			"status": "paid",
			"created_at": "2023-10-27 00:21:56",
			"updated_at": "2023-11-17 15:05:08"
		},
		{
			"id": 300,
			"client": "Neves-Rosa",
			"price": "782.44",
			"quantity": 6,
			"device": "mobile",
			"status": "refunded",
			"created_at": "2023-10-27 00:53:55",
			"updated_at": "2023-11-09 01:54:30"
		}
	],
	"links": {
		"first": "http:\/\/localhost:8000\/transactions?page=1",
		"last": "http:\/\/localhost:8000\/transactions?page=200",
		"prev": null,
		"next": "http:\/\/localhost:8000\/transactions?page=2"
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"last_page": 200,
		"links": [
			{
				"url": null,
				"label": "&laquo; Previous",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=1",
				"label": "1",
				"active": true
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=2",
				"label": "2",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=3",
				"label": "3",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=4",
				"label": "4",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=5",
				"label": "5",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=6",
				"label": "6",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=7",
				"label": "7",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=8",
				"label": "8",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=9",
				"label": "9",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=10",
				"label": "10",
				"active": false
			},
			{
				"url": null,
				"label": "...",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=199",
				"label": "199",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=200",
				"label": "200",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8000\/transactions?page=2",
				"label": "Next &raquo;",
				"active": false
			}
		],
		"path": "http:\/\/localhost:8000\/transactions",
		"per_page": 10,
		"to": 10,
		"total": 2000
	}
}
