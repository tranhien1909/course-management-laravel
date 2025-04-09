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
        width: 100%;
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
        background-color:rgb(225, 238, 244);
        opacity: 1;
    }

    #addForm {
        max-height: 100vh;
        /* Giới hạn chiều cao modal */
        overflow-y: auto;
        /* Tạo thanh cuộn khi nội dung quá dài */
    }

    .form-container {
        margin-top: 50px;
        position: fixed;
        top: 0;
        right: -550px;
        /* Ẩn ban đầu */
        width: 550px;
        height: calc(100% - 50px);
        background: white;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
        padding: 20px;
        transition: right 0.3s ease-in-out;
        z-index: 1001;
    }

    .form-container.active {
        right: 0;
        /* Hiện form */
    }

    .closebtn {
        background: none;
        color: red;
        /* Màu xám */
        font-size: 17px;
        border: none;
        cursor: pointer;
        position: absolute;
        top: 20px;
        left: 20px;
        /* Cách khoảng 10px */
        font-weight: bolder;
    }

    .form-container h2 {
        margin-left: 25px;
        color:  #3b6db3;
        font-weight: bolder;
        font-size: 17px;
    }

    .store {
        margin-left: 12px;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 12px;
        align-items: center;
        margin-top: 15px;
    }

    label {
        width: 100%;
        margin-top: 20px;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-footer {
        grid-column: span 2;
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .save-btn {
        background: #3b6db3;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        border: none;
        margin-right: 18px;
    }

    .delete-btn {
        background: none;
        border: none;
        color: black;
        font-size: 18px;
        cursor: pointer;
        margin-left: auto;
    }

    .avatar {
        justify-items: center;
    }

    .img-avatar {
        width: 100px;
        height: 100px;
        margin-top: 10px;
        cursor: pointer;
    }
</style>