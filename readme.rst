# Data Management Application

This is a web-based data management application that allows users to **Add**, **Edit**, **Delete (Single/Bulk)**, and **List** user records with form validation and MySQL database integration.

## 🚀 Features

- **Data Listing View with DataTable**:
  - Displays all records in a tabular format.
  - Columns: `Name`, `Company Name`, `Designation`, `Email ID`, and `Action`.
  - Each row has **Edit** and **Delete** buttons.
  
- **Form with Validation**:
  - Fields:
    - **Name** (Required)
    - **Company Name** (Required)
    - **Designation** (Optional)
    - **Email ID** (Required, with email format validation)
  - Form submission stores data in a MySQL database.
  - On successful submit, the user is redirected to the listing view.

- **Add Record**:
  - Accessible via the `ADD` button on the listing page.
  - Redirects to the form view.

- **Edit Record**:
  - Pre-fills form with selected record's data.
  - On submit, updates the record in the database and redirects to listing view.

- **Delete Record (Single & Bulk)**:
  - Each row has a delete button to remove the record individually.
  - Users can select multiple records using checkboxes and delete them using a **Delete Selected** button.
  - The `Delete Selected` button remains disabled until at least one record is selected.

## 📄 Flow Overview

1. **Default Page**:
   - Loads the Listing View by default.
2. **Add Button**:
   - Redirects to the Add Form.
3. **Form Submit**:
   - On valid input, saves the record to MySQL and redirects to the Listing Page.
4. **Edit**:
   - Opens the form pre-filled with existing data for editing.
5. **Delete**:
   - Deletes the record and reloads the Listing Page.
6. **Bulk Delete**:
   - Deletes all selected records and refreshes the Listing Page.

## 📦 Tech Stack

- **Frontend**: HTML, CSS, JavaScript, Bootstrap, DataTables.js
- **Backend**: PHP / Node.js / Python (based on your preferred stack)
- **Database**: MySQL

## 🔧 Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone <repo-url>
   cd data-management-app

