<?php 
namespace App\Http\Util;

class GerarPdfUtil {
     
	public static function gerarPdf($html) {
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

    public static function getCssPdf() {
		$css = '
		h4.text-center {
			text-align: center;
			font-size: 22px;
		}
		.text-warning {
			color: yellow;
		}
		.text-danger {
			color: red;
		}
		.text-success {
			color: green;
		}
		.text-primary {
			color: blue;
		}

		html {
			box-sizing: border-box;
		  }
		  
		  *,
		  *:before,
		  *:after {
			box-sizing: inherit;
		  }
		  
		  body {
			font-family: system-ui, -apple-system, BlinkMacSystemFont, "Avenir Next", "Avenir", "Segoe UI", "Lucida Grande", "Helvetica Neue", "Helvetica", "Fira Sans", "Roboto", "Noto", "Droid Sans", "Cantarell", "Oxygen", "Ubuntu", "Franklin Gothic Medium", "Century Gothic", "Liberation Sans", sans-serif;
			color: rgba(0, 0, 0, 0.87);
		  }
		  
		  a {
			color: #7eccd4;
		  }
		  a:hover, a:focus {
			color: #046a38;
		  }
		  
		  .container {
			margin: 5% 3%;
		  }
		  @media (min-width: 48em) {
			.container {
			  margin: 2%;
			}
		  }
		  @media (min-width: 75em) {
			.container {
			  margin: 2em auto;
			  max-width: 75em;
			}
		  }
		  
		  .responsive-table {
			width: 100%;
			margin-bottom: 1.5em;
			border-spacing: 0;
		  }
		  @media (min-width: 48em) {
			.responsive-table {
			  font-size: 0.9em;
			}
		  }
		  @media (min-width: 62em) {
			.responsive-table {
			  font-size: 1em;
			}
		  }
		  .responsive-table thead {
			position: absolute;
			clip: rect(1px 1px 1px 1px);
			/* IE6, IE7 */
			padding: 0;
			border: 0;
			height: 1px;
			width: 1px;
			overflow: hidden;
			color: black;
			font-weight: bold;
		  }
		  @media (min-width: 48em) {
			.responsive-table thead {
			  position: relative;
			  clip: auto;
			  height: auto;
			  width: auto;
			  overflow: auto;
    		  color: black;
			  font-weight: bold;

			}
		  }
		  .responsive-table thead th {
			text-align: left;
			color: black;
			font-weight: bold;
		  }
		  .responsive-table thead th:first-of-type {
			text-align: left;
		  }
		  .responsive-table tbody,
		  .responsive-table tr,
		  .responsive-table th,
		  .responsive-table td {
			display: block;
			padding: 0;
			text-align: left;
			white-space: normal;
		  }
		  @media (min-width: 48em) {
			.responsive-table tr {
			  display: table-row;
			}
		  }
		  .responsive-table th,
		  .responsive-table td {
			padding: 0.5em;
			vertical-align: middle;
		  }
		  @media (min-width: 30em) {
			.responsive-table th,
		  .responsive-table td {
			  padding: 0.75em 0.5em;
			}
		  }
		  @media (min-width: 48em) {
			.responsive-table th,
		  .responsive-table td {
			  display: table-cell;
			  padding: 0.5em;
			}
		  }
		  @media (min-width: 62em) {
			.responsive-table th,
		  .responsive-table td {
			  padding: 0.75em 0.5em;
			}
		  }
		  @media (min-width: 75em) {
			.responsive-table th,
		  .responsive-table td {
			  padding: 0.75em;
			}
		  }
		  .responsive-table caption {
			margin-bottom: 1em;
			font-size: 1em;
			font-weight: bold;
			text-align: center;
		  }
		  @media (min-width: 48em) {
			.responsive-table caption {
			  font-size: 1.5em;
			}
		  }
		  .responsive-table tfoot {
			font-size: 0.8em;
			font-style: italic;
		  }
		  @media (min-width: 62em) {
			.responsive-table tfoot {
			  font-size: 0.9em;
			}
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody {
			  display: table-row-group;
			}
		  }
		  .responsive-table tbody tr {
			margin-bottom: 1em;
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody tr {
			  display: table-row;
			  border-width: 1px;
			}
		  }
		  .responsive-table tbody tr:last-of-type {
			margin-bottom: 0;
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody tr:nth-of-type(even) {
			  background-color: rgba(0, 0, 0, 0.12);
			}
		  }
		  .responsive-table tbody th[scope=row] {
			color: black;
		  }
		  @media (min-width: 30em) {
			.responsive-table tbody th[scope=row] {
			  border-left: 1px solid #2527308c;
			  border-bottom: 1px solid #2527308c;
			}
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody th[scope=row] {
			  background-color: transparent;
			  color: #000001;
			  text-align: left;
			}
		  }
		  .responsive-table tbody td {
			text-align: left;
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody td {
			  border-left: 1px solid #2527308c;
			  border-bottom: 1px solid #2527308c;
			  text-align: center;
			}
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody td:last-of-type {
			  border-right: 1px solid #2527308c;
			}
		  }
		  .responsive-table tbody td[data-type=currency] {
			text-align: center;
		  }
		  .responsive-table tbody td[data-title]:before {
			content: attr(data-title);
			float: left;
			font-size: 0.8em;
			color: rgba(0, 0, 0, 0.54);
		  }
		  @media (min-width: 30em) {
			.responsive-table tbody td[data-title]:before {
			  font-size: 0.9em;
			}
		  }
		  @media (min-width: 48em) {
			.responsive-table tbody td[data-title]:before {
			  content: none;
			}
		  }
		';

		return $css;
	}
}