<style>

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 1000;
    }

    .overlay.active {
        display: block;
    }

    .breadcrumb {
        margin-top: 20px;
    }

    .add-btn {
        background: #3b6db3;
        color: white;
        font-size: 14px;
        padding: 3px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 20px;
    }

    .filter-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
        margin-left: 30px;
    }

    .filter-bar button {
        background: #3b6db3;
        color: white;
        padding: 9px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .filter-bar button:hover {
        background: #345a96;
    }

    .filter-bar select,
    .filter-bar input {
        padding: 9px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .filter-bar select {
        width: 200px;
    }

    .search-container {
        position: relative;
        flex: 1;
    }

    .search-container input {
        width: 97%;
        padding: 9px;
        padding-left: 40px;
        /* Tạo khoảng cách bên trái đủ cho icon */
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 10px;
        /* Điều chỉnh vị trí icon */
        transform: translateY(-50%);
        font-size: 14px;
        color: gray;
    }

    .table-container {
        width: 100%;
        overflow-y: auto;
        /* Bật cuộn dọc nếu bảng quá dài */
        background: white;
        margin-top: 60px;
        margin-left: 30px;
    }

    .table-container::-webkit-scrollbar {
        display: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px 8px;
        text-align: center;
    }

    th {
        background-color: #3b6db3;
        color: white;
        font-weight: bold;

        position: sticky;
        top: 0;
        z-index: 1; /* Ensures header stays above the table content */
        text-align: center;
        padding: 10px;
    }

    td {
        max-height: unset;
        white-space: normal;
        word-wrap: break-word;
    }

    .course-row {
        background-color: white;
        opacity: 1;
        transition: background 0.3s ease, opacity 0.3s ease;
    }

    .course-row.selected {
        background-color:rgb(193, 225, 240);
        opacity: 1;
    }
</style>