# PHP測驗，程式架構

# 聲明

求職用作業，非相關人等請勿複製或改用。 

# 類別職責規劃

## Entity

- 用以表達商業邏輯的實體，不包含任何跟持久層( 資料庫、文件等等 )的邏輯。
- 通常僅有資料欄位。
    ```php
    app\Entities
    ```

## Repository

- 分為介面與實作。介面是提供上層類別操作的契約，而實做則將持久層轉化成抽象實體Entity或單純實做方法。
- 其它類別操作都必須使用介面操作功能，實做由Service Provider決定。
- 目錄

    ```php
    app\Repositories
    ```

## Service

- 負責操作Repository來達成進一步的商業邏輯。
- 一個類別代表一步商業步驟( 例如 : 使用者登入 )，通常僅有execute方法。
- 目錄

    ```php
    app\Services
    ```

## DTO

- 用以根據用途，包裝傳送尚未成為Entity的變數。
- 通常是純資料物件。

    ```php
    app\DTOs
    ```
