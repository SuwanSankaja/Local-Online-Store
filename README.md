# Local Online Store

Welcome to the **Local Online Store**! This project is a PHP-based e-commerce platform designed to provide a robust and scalable foundation for online shopping. It features user-friendly navigation, seamless cart management, and a comprehensive database structure to manage products, categories, and orders.

---

## 🚀 Features

- **Dynamic Home Page**:
  - Displays categories, subcategories, and products dynamically from the database.
- **User-friendly Cart Management**:
  - Add, remove, and manage products in the cart with session tracking.
- **Scalable Database Design**:
  - Optimized schema with support for categories, products, variants, and user orders.
- **MVC Architecture**:
  - Clean and maintainable codebase following the Model-View-Controller pattern.

---

## 📂 Project Structure

```
Local-Online-Store
├── index.php                # Main entry point
├── DB_exports/
│   └── e_commerce_db.sql    # Database schema and initial data
├── app/
│   ├── controllers/         # Handles application logic (e.g., Home, Cart)
│   ├── models/              # Interacts with the database
│   └── views/               # Manages the user interface
├── core/                    # Core application classes
├── config/                  # Configuration files
└── public/                  # Publicly accessible files (e.g., assets)
```

---

## 🛠️ Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/SuwanSankaja/local-online-store.git
   cd local-online-store
   ```

2. **Set Up the Database**:
   - Import the database:
     ```bash
     mysql -u username -p database_name < DB_exports/e_commerce_db.sql
     ```
   - Update your database credentials in `config/config.php`.

3. **Configure the Web Server**:
   - Ensure your server supports PHP and has `mod_rewrite` enabled.
   - Point the document root to the `public/` folder.

4. **Run the Application**:
   - Access the application in your browser at `http://localhost/`.

---

## 🔧 Technologies Used

- **Backend**: PHP (MVC framework)
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL/MariaDB
- **Server**: Apache with mod_rewrite

---

## 📖 Usage

1. **Homepage**:
   - Browse categories and products.
2. **Add to Cart**:
   - Add products to your cart for checkout.
3. **Manage Cart**:
   - View or update your cart items dynamically.

---

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork this repository.
2. Create a feature branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m 'Add some feature'
   ```
4. Push to the branch:
   ```bash
   git push origin feature-name
   ```
5. Open a pull request.

---


