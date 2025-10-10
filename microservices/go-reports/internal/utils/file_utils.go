package utils

import (
	"os"
	"path/filepath"
)

// CleanupOldReports remove relatórios antigos do diretório após 'maxFiles'
func CleanupOldReports(dir string, maxFiles int) {
	files, err := os.ReadDir(dir)
	if err != nil || len(files) <= maxFiles {
		return
	}

	for _, file := range files[:len(files)-maxFiles] {
		path := filepath.Join(dir, file.Name())
		os.Remove(path)
	}
}
