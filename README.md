# Nome do Projeto
 Sale-system
## Tecnologias Utilizadas
- **PHP 8.3**
- **Laravel 11**
- **Livewire 3**
- **Horizon para Controle de Filas**

## Pré-requisitos

Antes de executar o projeto, certifique-se de ter o Docker instalado na sua máquina. Você pode baixar e instalar o Docker [aqui](https://www.docker.com/get-started).

## Execução do Projeto

Siga os passos abaixo para executar o projeto:

1. Copie o arquivo de exemplo de configuração:

   ```bash
   cp .env.example .env
   ```

   Ou, se preferir, copie o arquivo e renomeie-o:

   ```bash
   # Copie manualmente .env.example para .env e faça as alterações necessárias
   ```

2. Crie as imagens do Docker:

   ```bash
   docker-compose build
   ```

3. Inicie os contêineres em segundo plano:

   ```bash
   docker-compose up -d
   ```

4. Acesse o aplicativo em seu navegador através da URL [http://localhost](http://localhost).
   ```bash
   #Caso, a porta 80 estiver em uso podera ser trocada manualmente no .env DOCKER_HTTP_PORT
   ```


## Configuração

Certifique-se de que suas variáveis de ambiente estão configuradas corretamente no arquivo `.env`. 

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
