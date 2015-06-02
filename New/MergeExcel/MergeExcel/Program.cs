using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Reflection;
using Microsoft.Office.Interop.Excel;
using System.IO;
using Excel = Microsoft.Office.Interop.Excel;

namespace MergeExcel1
{
   class Program
    {
       static void Main(string[] args)
            {
                string[] filearray = Directory.GetFiles(@"C:\xampp\htdocs\smit\uploads\Input\", "*.xls");

                MergeExcel.DoMerge(filearray, @"C:\xampp\htdocs\smit\Output\result.xlsx");
            }
    }
   

    public class MergeExcel
    {
        Excel.Application app = new Microsoft.Office.Interop.Excel.Application();
                
        

        Excel.Workbook bookDest = null;
        Excel.Worksheet sheetDest = null;

        Excel.Workbook bookSource = null;
        Excel.Worksheet sheetSource = null;
        string[] _sourceFiles = null;
        string _destFile = string.Empty;
        string templateFile = @"C:\xampp\htdocs\smit\Output\template.xlsx";
        
        public MergeExcel(string[] sourceFiles, string destFile)
        {
            app.DisplayAlerts = false;
            //bookDest = app.Workbooks._Open(destFile, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value);
            //sheetDest = (Excel.Worksheet)bookDest.Worksheets["CURYR"];
            _sourceFiles = sourceFiles;
            _destFile = destFile;

            bookDest = (Excel.Workbook)app.Workbooks.Add(Missing.Value);
            sheetDest = bookDest.Worksheets.Add(Missing.Value, Missing.Value, Missing.Value, Missing.Value) as Excel.Worksheet;
            sheetDest.Name = "CURYR";
            OpenBook(templateFile);
            Excel.Range rangeSourceItems = sheetSource.get_Range("A1","B1039");
            Excel.Range rangeSourceHeadings = sheetSource.get_Range("C1", "H3");
            Excel.Range rangeDestItems = sheetDest.get_Range("A1", Missing.Value);
            Excel.Range rangeDestHeadings = sheetDest.get_Range("C1", Missing.Value);            
            rangeSourceItems.Copy(Missing.Value);
            rangeDestItems.PasteSpecial(XlPasteType.xlPasteValues,XlPasteSpecialOperation.xlPasteSpecialOperationNone,true,false);
            rangeSourceHeadings.Copy(Missing.Value);
            rangeDestHeadings.PasteSpecial(XlPasteType.xlPasteValues, XlPasteSpecialOperation.xlPasteSpecialOperationNone, true, false);
            CloseBook(templateFile);
            
        }

        public static string ExcelColumnFromNumber(int column)
        {
            string columnString = "";
            decimal columnNumber = column;
            while (columnNumber > 0)
            {
                decimal currentLetterNumber = (columnNumber - 1) % 26;
                char currentLetter = (char)(currentLetterNumber + 65);
                columnString = currentLetter + columnString;
                columnNumber = (columnNumber - (currentLetterNumber + 1)) / 26;
            }
            return columnString;
        }

        /*public static int NumberFromExcelColumn(string column)
        {
            int retVal = 0;
            string col = column.ToUpper();
            for (int iChar = col.Length - 1; iChar >= 0; iChar--)
            {
                char colPiece = col[iChar];
                int colNum = colPiece - 64;
                retVal = retVal + colNum * (int)Math.Pow(26, col.Length - (iChar + 1));
            }
            return retVal;
        }
        */

        void OpenBook(string fileName)
        {
            bookSource = app.Workbooks._Open(fileName, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value, Missing.Value);
            sheetSource = (Excel.Worksheet)bookSource.Worksheets["CURYR"];
        }


        void CloseBook(string fileName)
        {
            bookSource.Close(true, fileName, Missing.Value);
        }

        
        void CopyData(string fileName)
        {
            Excel.Range rangeSource = sheetSource.get_Range("C3", "E1039");
            int currCol = (1/3);
            Console.WriteLine(fileName);
                                    
            switch(fileName)
            {
                case @"C:\xampp\htdocs\smit\uploads\Input\Kanpur Accts 2013-14.xls":
                    Console.WriteLine(fileName);
                    currCol = 3;
                    break;
                case @"C:\xampp\htdocs\smit\uploads\Input\Korwa Accts 2013-14.xls":
                    Console.WriteLine(fileName);
                    currCol = 6;
                    break;
                default:
                    return;
 
            }  
            
            int endcolumn = currCol +2;
            string columnStart = ExcelColumnFromNumber(currCol);
            string columnEnd = ExcelColumnFromNumber(endcolumn); 
            Excel.Range rangeDest = sheetDest.get_Range(columnStart+"3",columnEnd+"1039");
            rangeSource.Copy();
            rangeDest.PasteSpecial(XlPasteType.xlPasteValues, XlPasteSpecialOperation.xlPasteSpecialOperationNone, true, false);
            
        }


        void Save()
        {
            bookDest.Saved = true;
            bookDest.SaveAs(_destFile);
        }


        void Quit()
        {
            System.Runtime.InteropServices. Marshal.ReleaseComObject(bookDest);
            System.Runtime.InteropServices. Marshal.ReleaseComObject(sheetDest);
            System.Runtime.InteropServices. Marshal.ReleaseComObject(bookSource);
            System.Runtime.InteropServices. Marshal.ReleaseComObject(sheetSource);
            app.Quit();
            
        }

        void DoMerge()
        {
            
            foreach (string strFile in _sourceFiles)
            {
                OpenBook(strFile);
                CopyData(strFile);
                CloseBook(strFile);
            }

            Save();
            Quit();

        }

        public static void DoMerge(string[] sourceFiles, string destFile)
        {
            new MergeExcel(sourceFiles, destFile).DoMerge();
        }
               
    }
}