package reports

import (
	"fmt"
	"os"
	"time"

	"go-reports/internal/utils"

	"github.com/xuri/excelize/v2"
)

// GenerateExcelReport cria um relatório XLSX temporário e retorna o caminho do arquivo
func GenerateExcelReport() (string, error) {
	f := excelize.NewFile()
	sheet := "Relatório"
	f.NewSheet(sheet)

	headers := []string{"Produto", "Vendas", "Lucro"}
	for i, h := range headers {
		col := string('A' + i)
		f.SetCellValue(sheet, fmt.Sprintf("%s1", col), h)
	}

	data := GenerateJSONReport()
	for i, row := range data {
		f.SetCellValue(sheet, fmt.Sprintf("A%d", i+2), row.Product)
		f.SetCellValue(sheet, fmt.Sprintf("B%d", i+2), row.Sales)
		f.SetCellValue(sheet, fmt.Sprintf("C%d", i+2), fmt.Sprintf("%.2f", row.Profit))
	}

	filePath := fmt.Sprintf("reports/report_%d.xlsx", time.Now().Unix())
	os.MkdirAll("reports", os.ModePerm)
	if err := f.SaveAs(filePath); err != nil {
		return "", err
	}

	utils.CleanupOldReports("reports", 10) // remove arquivos antigos
	return filePath, nil
}
