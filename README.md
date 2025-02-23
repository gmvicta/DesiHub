## About Desiplos Vape Hub

Desiplos Vape Hub is an advanced vape shop management system designed to streamline inventory, sales, and customer loyalty programs. Built with Laravel 10 for the backend and Vue 3 for the frontend, the system integrates key features like:

- **RFID-based authentication** for seamless customer check-ins.
- **Loyalty rewards system** to enhance customer engagement.
- **Sentiment analysis** for customer feedback evaluation.
- **Inventory management** for real-time stock updates.
- **Sales analytics** to track performance and insights.

Desiplos Vape Hub provides an all-in-one solution for vape shop owners to optimize their business operations efficiently.

## Features

- **User Authentication** (RFID login and traditional login/register pages)
- **Product Management** (CRUD operations for vape products and accessories)
- **Loyalty Program** (Point-based reward system)
- **Sales & Inventory Tracking** (Real-time stock and transaction logs)
- **Sentiment Analysis** (Customer feedback interpretation using AI)
- **Sales Analytics Dashboard** (Charts and insights for decision-making)

## Tech Stack

- **Backend:** Laravel 10 (PHP 8.1)
- **Frontend:** Vue 3 + Tailwind CSS
- **Database:** MySQL / PostgreSQL
- **Authentication:** Laravel Sanctum (for API authentication)
- **Machine Learning:** Python (for sentiment analysis)

## Installation Guide

1. **Clone the repository**
   ```sh
   git clone https://github.com/your-repo/desihub.git
   cd desihub
   ```
2. **Install backend dependencies**
   ```sh
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
3. **Configure database** in `.env` file and run migrations:
   ```sh
   php artisan migrate --seed
   ```
4. **Install frontend dependencies**
   ```sh
   cd frontend
   npm install
   npm run dev
   ```
5. **Start the server**
   ```sh
   php artisan serve
   ```

## Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Guide](https://vuejs.org/guide/introduction.html)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## Contributing

Contributions are welcome! If you have suggestions or would like to contribute, please fork the repository and submit a pull request.

## Security Vulnerabilities

If you discover a security vulnerability, please report it to the project maintainers privately.

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

