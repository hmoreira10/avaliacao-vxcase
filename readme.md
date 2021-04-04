# Avaliação para vaga de DEV VX CASE

## Stack de Tecnologia:  
Laravel  
Vue/Vuex  
Bulma  

## Instalação com Docker
 1. Clone este repositório  
 ` git clone https://github.com/hmoreira10/avaliacao-vxcase.git`  
 `cd avaliacao-vxcase`
 2. Inicie o Docker
 ` docker-compose up -d --build `
 ` docker exec -it avaliacao-vxcase_laravel-app_1 bash `
 3. Instale as dependencias  
 ` composer install`  
 3. Configure o ambiente  
 `cp .env.example .env`
   - Coloque a senha do banco de dados no .env
   `nano .env`  Senha=laravel
 `php artisan key:generate`  
    
4. Acesse a aplicacao
 `127.0.0.1:8080`

## Instalação sem Docker

 1. Clone este repositório
 `git clone https://github.com/eufelpsdev/avaliacao-vx-backend.git`
 `cd sale-system`
 2. Instale as dependencias
 `composer install`
 3. Configure o ambiente
 `cp .env.example .env`
 `php artisan key:generate`
 4. Popule o banco de dados mysql
 `php artisan migrate --seed`
 5. Rode o servidor
 `php artisan serve`


## ISSUES RESPONDIDOS

- #1 - Repositories (FEITO)
- #2 - FormRequest (FEITO)
- #3 - Artisan command (FEITO)
- #4 - Docker no projeto (FEITO)
- #5 - Organizar Models (FEITO)
- #6 - Criar job (FEITO)

