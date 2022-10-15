<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .unit-wrapper .table-main-wrapper {
            overflow-x: auto;
            margin-top: 30px;
            font-family: Poppins,Helvetica,sans-serif;
        }

        .unit-wrapper table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        
        .unit-wrapper th,
        .unit-wrapper td {
            text-align: left;
            padding: 8px;
            border: none;
        }

        .unit-wrapper input {
            background:none;
            border:1px solid #eee;
            border-radius: 5px;
            font-size: 14px;
            padding: 7px 10px;
            color: #000;
            margin: 0 0 5px;
        }

        .unit-wrapper label {
            font-size: 16px;
            color: #000;
            text-transform: capitalize;
        }

        .unit-wrapper select {
            background:none;
            border:1px solid #eee;
            border-radius: 5px;
            font-size: 14px;
            padding: 7px 10px;
            color: #000;
        }

        .unit-wrapper ::placeholder {
            font-size: 14px;
            color: #000;
        }

        .unit-wrapper .cmn-box {
            padding: 20px 25px;
            box-shadow: 0 0 20px 0 rgb(76, 87, 125, 0.1);
            border-radius: 10px;
            background: #fff;
        }

        .unit-wrapper .from-to-wrap input,
        .unit-wrapper .unit-wrap input {
            max-width: 100px;
        }
        /* body {
            background-color: #f5f8fa;
        } */
    </style>
</head>

<body>

    <section class="unit-wrapper">
        <div class="container mt-3">
            <div class="d-flex floor-wrap cmn-box">
                 <div class="form-group">
                     <label for="">Floor</label>
                     <input type="text">
                 </div>
                 <div class="form-group">
                     <label for="">BP</label>
                     <input type="text">
                 </div>
                 <div class="form-group">
                     <label for="">Initial name</label>
                     <input type="text">
                 </div>
            </div>
         
            <div class="table-main-wrapper cmn-box">
                 <table class="table">
                     <tbody>
                         <tr>
                             <td>
                                 <label for="">categories</label>
                                 <select name="" id="">
                                     <option value="">categories 1</option>
                                     <option value="">categories 1</option>
                                     <option value="">categories 1</option>
                                 </select>
                             </td>
                             <td>
                                 <div class="d-flex from-to-wrap">
                                     <div>
                                         <label for="">From</label>
                                         <input type="text">
                                     </div>
                                     <div>
                                         <label for="">to</label>
                                         <input type="text">
                                     </div>
                                 </div>
                             </td>
                             <td>
                                 <div class="unit-wrap">
                                     <label for="">unit</label>
                                     <input type="text">
                                 </div>
                             </td>
                             <td>
                                 <input type="text" disabled value="A-101">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">
                             </td>
                             <td>
                                 <input type="text" disabled value="A-102">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">     
                             </td>
                 
                             <td>
                                 <input type="text" disabled value="A-102">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">     
                             </td>
                             <td>
                                 <input type="text" disabled value="A-102">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">     
                             </td>
                             <td>
                                 <input type="text" disabled value="A-102">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">     
                             </td>
                             <td>
                                 <input type="text" disabled value="A-102">
                                 <input type="text" placeholder="Sq. Ft.">
                                 <input type="text" placeholder="Booking price">     
                             </td>
                         </tr>
                     </tbody>
                 </table>
            </div>
         
         </div>
    </section>










<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
