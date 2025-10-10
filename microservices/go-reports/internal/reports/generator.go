package reports

import (
	"math/rand"
	"time"
)

// ReportItem representa um item do relatório JSON
type ReportItem struct {
	Product string  `json:"product"`
	Sales   int     `json:"sales"`
	Profit  float64 `json:"profit"`
}

// GenerateJSONReport gera um relatório de exemplo em formato JSON
func GenerateJSONReport() []ReportItem {
	rand.Seed(time.Now().UnixNano())
	items := []ReportItem{
		{"Notebook", rand.Intn(500), rand.Float64() * 5000},
		{"Mouse", rand.Intn(300), rand.Float64() * 1000},
		{"Teclado", rand.Intn(250), rand.Float64() * 1500},
		{"Monitor", rand.Intn(200), rand.Float64() * 3000},
	}

	return items
}
