# Shopato - Used Goods E-commerce Platform

*Read this in other languages: [Português 🇧🇷](README_PT.md)*

**Shopato** is an e-commerce marketplace focused on buying and selling used items (OLX-style), featuring a visual identity inspired by Mercado Livre and Shopee. The platform simulates a full-featured environment where standard users can create accounts, publish detailed listings with images of their products, and make simulated purchases through an interactive virtual shopping cart.

This project was developed as an evaluation requirement for the **Full-Stack Development** course during the first semester of 2025, in the **Bachelor's Degree in Computer Engineering** program at **Instituto Federal de São Paulo (IFSP) - Campus Guarulhos**.

### [Store Homepage]

<img width="800" alt="Captura de tela 2026-07-15 165834" src="https://github.com/user-attachments/assets/71490dc4-cb7c-4dca-8724-d6ff6a1a4499" />

---

### [Profile / Your Listings]

<img width="800" alt="Captura de tela 2026-07-15 165948" src="https://github.com/user-attachments/assets/24f7c16c-df05-4147-bbfa-8a5575c9412b" />

---

### [Listing Details]

<img width="800" alt="Captura de tela 2026-07-15 170038" src="https://github.com/user-attachments/assets/71d80214-2303-4f27-b933-7a0cfcb8f10b" />

---

### [Shopping Cart]

<img width="800" alt="Captura de tela 2026-07-15 170110" src="https://github.com/user-attachments/assets/c4925082-2d9c-4930-a1ca-64a60cc3c690" />

---

## Evolution Journey: From Procedural PHP to Laravel MVC

The main technical highlight of this project lies in its architecture. Development was divided into two distinct phases, simulating a real-world software legacy modernization scenario:

1.  **Legacy Phase:** The system was initially built using pure (procedural) PHP, utilizing an architecture based on isolated pages and direct database queries.
2.  **Migration Phase:** The entire application was migrated to the **Laravel** framework. The codebase was completely refactored and reorganized under the **MVC (Model-View-Controller)** pattern, leveraging centralized routing, specialized controllers, reusable Blade components, and ORM for secure database operations.

---

## Technologies & Tools Used

*   **Programming Language:** PHP.
*   **Backend Framework:** Laravel.
*   **Relational Database:** MariaDB / phpMyAdmin.
*   **Frontend & Interface:**
    *   Blade Templates (Laravel's native templating engine).
    *   AdminLTE Base Template (customized with yellow and white color schemes inspired by Mercado Livre).
    *   Bootstrap (Responsive layout).
    *   HTML5, CSS3, and JavaScript (Client-side dynamic interactions).
    *   Font Awesome (Icon library).
*   **Development Tool:** VS Code.

---

## Key Features

*   **Native Authentication:** User registration, login/logout control, and secure session persistence powered by Laravel's native ecosystem.
*   **Profile Management:** Dedicated user profile page displaying account details, total listed items, active listings, and profile picture updates.
*   **Dynamic Listings System:** Creation of product listings with titles, detailed descriptions, prices, and upload of up to 3 product images. Each listing features a public view with a photo gallery, seller contact info, and a quantity selector.
*   **Custom Storefronts:** Every registered seller has a public "storefront" page displaying their location, profile picture, and a gallery showcasing all their active listings.
*   **Shopping Cart:** Add items to cart, adjust quantities with real-time automatic subtotal and total updates, and item removal option.
*   **About / Institutional Page:** "About" section detailing the academic purpose of the project, platform workflow overview, and mock user reviews.

---

## Security & Data Validation

The application enforces multi-layer validations to shield the system against vulnerabilities and errors:
1.  **Client-Side Layer (Frontend):** Instant form validations using native HTML5 attributes and JavaScript scripts to enhance User Experience (UX).
2.  **Server-Side Layer (Backend):** Strict file-type validation (image uploads), required field checks, and input sanitization via Laravel's built-in validator, ensuring data integrity and preventing injection attacks.

---

## How to Run the Project Locally

Follow the steps below to configure the environment and run the project locally:

1.  **Prepare Local Server Environment:**
    *   Ensure **XAMPP** (or a similar stack supporting PHP and MariaDB/MySQL) is installed with Apache and MySQL services running.
2.  **Place Project Files:**
    *   Move or clone the `shopato` folder into your local server's web root directory (e.g., `C:\xampp\htdocs\` on Windows).
3.  **Configure the Database:**
    *   Open your database management tool (such as phpMyAdmin) and create a new database.
    *   Import the provided `duck.sql` database file to establish tables and initial data.
4.  **Configure Environment Variables:**
    *   In the project root directory, configure the `.env` file with your local database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
5.  **Run the Application:**
    *   Open terminal inside the `shopato` folder and execute:
        ```bash
        php artisan serve
        ```
    *   Access the local URL provided in the terminal (typically `http://127.0.0.1:8000`) in your browser.

---

## Testing Credentials

To explore the platform as an existing user without creating a new account, use the following pre-configured credentials:

*   **Email:** `email@gmail.com`
*   **Password:** `senha`

---

## Academic Information & Authors

Practical project developed to consolidate software engineering and full-stack web development concepts.

*   **Course Advisor / Professor:** Reginaldo do Prado.
*   **Author (Student):**
    *   Nathan Iglesias Gomes de Oliveira
