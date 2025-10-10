package handlers

import (
	"go-reports/internal/reports"

	"github.com/gofiber/fiber/v2"
)

// GenerateReport
// Handler HTTP que gera um relatório baseado no tipo especificado (JSON ou XLSX)
func GenerateReport(c *fiber.Ctx) error {
	reportType := c.Query("type", "json") // "json" ou "xlsx"

	if reportType == "xlsx" {
		filePath, err := reports.GenerateExcelReport()
		if err != nil {
			return c.Status(500).JSON(fiber.Map{"error": err.Error()})
		}
		return c.JSON(fiber.Map{
			"status": "ok",
			"file":   filePath,
		})
	}

	// Caso padrão: relatório JSON
	data := reports.GenerateJSONReport()
	return c.JSON(fiber.Map{
		"status": "ok",
		"report": data,
	})
}
