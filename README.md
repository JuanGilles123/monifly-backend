# 🚀 MoniFly Backend

**MoniFly** is a comprehensive financial management backend built with Laravel, featuring advanced authentication, financial goal tracking, and modern UI components.

## ✨ Features

### 🔐 Authentication & Security
- ✅ **Email Verification** - Required for protected routes
- ✅ **Google OAuth Integration** - Seamless social login with account linking
- ✅ **Traditional Authentication** - Laravel Breeze implementation
- ✅ **Password Reset** - Complete recovery flow

### 🎯 Financial Management
- ✅ **Goal Tracking System** - Create and monitor financial objectives
- ✅ **Progress Visualization** - Real-time progress bars and statistics
- ✅ **Multi-Currency Support** - International currency handling
- ✅ **Cent-based Storage** - Precise financial calculations

### 🌟 Enhanced Registration
- ✅ **Extended User Profiles** - Country, preferred currency, and more
- ✅ **Initial Goal Creation** - Set financial targets during registration
- ✅ **Smart Validation** - Comprehensive form validation
- ✅ **Modern UI** - Tailwind CSS with country/currency selectors

### 📊 Dashboard & Analytics
- ✅ **Financial Statistics** - Total goals, completed goals, progress amounts
- ✅ **User Profile Integration** - Avatar, verification status, OAuth info
- ✅ **Responsive Design** - Mobile-friendly interface
- ✅ **Real-time Data** - Live updates from PostgreSQL database

## 🛠️ Technology Stack

- **Backend**: Laravel 11.x
- **Database**: PostgreSQL (DigitalOcean)
- **Authentication**: Laravel Breeze + Socialite
- **Frontend**: Blade Templates + Tailwind CSS
- **Email**: Laravel Mail (configurable)
- **Cache**: Database cache driver

## 🗄️ Database Schema

### Users Table
```sql
- id, name, email, email_verified_at, password
- country (ISO 2-char), currency_preferred (ISO 3-char)
- provider, provider_id, google_id, avatar_url
- phone, birth_date, gender
- timezone, language, monthly_income
- financial_goals, notifications_enabled
- profile_completed, last_active_at
- timestamps
```

### Goals Table
```sql
- id, user_id (FK), name
- target_cents, progress_cents, currency
- target_date, timestamps
```

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+ with PostgreSQL extension
- Composer
- Node.js & npm
- PostgreSQL database

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/JuanGilles123/monifly-backend.git
cd monifly-backend
```

2. **Install dependencies**
```bash
composer install
npm install && npm run build
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure environment variables**
```env
# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host
DB_PORT=25060
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
DB_SSLMODE=require

# Google OAuth
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Start the server**
```bash
php artisan serve
```

## 🔧 Configuration

### Google OAuth Setup
1. Create a Google Cloud Project
2. Enable Google+ API
3. Create OAuth 2.0 credentials
4. Add your domain to authorized URLs
5. Configure callback: `https://yourdomain.com/auth/google/callback`

### DigitalOcean Deployment
The app is ready for DigitalOcean App Platform deployment:
- ✅ Dockerfile included
- ✅ Environment variables configured
- ✅ PostgreSQL database integration
- ✅ Static asset building

## 📱 API Endpoints

### Authentication
- `GET /` - Welcome page
- `GET /register` - Registration form
- `POST /register` - User registration
- `GET /login` - Login form  
- `POST /login` - User authentication
- `GET /auth/google/redirect` - Google OAuth redirect
- `GET /auth/google/callback` - Google OAuth callback

### Protected Routes (requires `auth` + `verified`)
- `GET /dashboard` - User dashboard with statistics
- `GET /profile` - User profile management
- Additional routes can be added to the `verified` middleware group

## 🧪 Testing

### Manual Testing Checklist
- [ ] User registration with all fields
- [ ] Email verification flow
- [ ] Google OAuth login/registration
- [ ] Dashboard statistics accuracy
- [ ] Financial goal creation
- [ ] Multi-currency support
- [ ] Mobile responsiveness

### Database Testing
```bash
php artisan tinker

# Check user count
App\Models\User::count()

# Check goals with users
App\Models\Goal::with('user')->get()

# Verify user relationships
App\Models\User::with('goals')->first()
```

## 🔒 Security Features

- ✅ **CSRF Protection** - All forms protected
- ✅ **SQL Injection Prevention** - Eloquent ORM
- ✅ **Password Hashing** - bcrypt encryption
- ✅ **Email Verification** - Mandatory verification
- ✅ **OAuth Security** - Stateless implementation
- ✅ **Input Validation** - Comprehensive form validation

## 🌍 Internationalization

Currently supports:
- **Countries**: US, CA, MX, CO, AR, BR, CL, PE, EC, ES, GB, FR, DE
- **Currencies**: USD, EUR, CAD, MXN, COP, ARS, BRL, CLP, PEN, GBP
- Easy to extend with additional countries/currencies

## 📈 Performance Features

- ✅ **Cent-based Math** - Precise financial calculations
- ✅ **Database Indexing** - Optimized queries
- ✅ **Eager Loading** - Relationship optimization
- ✅ **Asset Compilation** - Vite build system
- ✅ **Caching** - Database cache driver

## 🚧 Future Enhancements

- [ ] **Transaction Management** - Income/expense tracking
- [ ] **Budget Categories** - Spending categorization
- [ ] **Financial Reports** - Charts and analytics
- [ ] **Notification System** - Email/push notifications
- [ ] **Mobile API** - RESTful API for mobile apps
- [ ] **Social Features** - Goal sharing and challenges

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🔗 Links

- **Repository**: https://github.com/JuanGilles123/monifly-backend
- **Live Demo**: Coming soon on DigitalOcean
- **Documentation**: This README

---

**Built with ❤️ by Juan José** for the MoniFly financial management platform.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
