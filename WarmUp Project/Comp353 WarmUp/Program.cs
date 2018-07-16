using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Comp353_WarmUp
{
    /// <summary>
    /// A simple script which generates INSERT INTO statements for the employees table.
    /// </summary>
    class Program
    {
        static void Main(string[] args)
        {


            string firstNamesStr = "Sherika Nilsa Silvana Afton Frankie Miles Florentina Willian Sona Yong Dianne German Gordon Artie Davis Magaret Manuela Marlin Ceola Alina Sebrina Berna Lauralee Rachael Natisha Karl Juliane Dorthy Shawnta Jerica Janel Chung Gracia Maxine Leandra Delila Greg Earlene Devin Francie Shaunda Mahalia Billy Luetta Sharolyn Kami Tomasa Willow Mila Ileana";
            string lastNamesStr = "Fields Downs Erickson Flowers Phelps Hampton Wheeler Hartman Carter Rodriguez Ali Mcgee Day Coffey Hancock Wise Estes Carlson Kline Lyons Harper Mcmahon Hebert Mathis Holt Burke Bowers Hoover Butler Walters Krueger Mcconnell Mercer Cortez Blevins Harrison Romero Benson Blankenship Gardner Shelton Adkins Farrell Mathews Daugherty Phillips Rocha Best Whitney Pineda";

            List<string> firstNames = firstNamesStr.Split(' ').ToList();
            List<string> lastNames = lastNamesStr.Split(' ').ToList();
            List<string> departmentList = new List<string>{ "'Development'", "'QA'", "'UI'", "'Design'", "'BusinessIntelligence'", "'Networking'" };

            Random rand = new Random();
            int employeeMaxAmount;
            int companyMaxAmount = 6;
            int departmentIndex;
            int firstNameIndex;
            int lastNameIndex;

            // For random employees
            //using (StreamWriter writer = new StreamWriter("Employees.txt"))
            //{
            //    for (int contractID = 1; contractID <= companyMaxAmount; contractID++)
            //    {
            //        employeeMaxAmount = rand.Next(4, 12);

            //        for (int k = 0; k < employeeMaxAmount; k++)
            //        {
            //            departmentIndex = rand.Next(6);
            //            firstNameIndex = rand.Next(50);
            //            lastNameIndex = rand.Next(50);
                        
            //            //For random employees;
            //            writer.WriteLine($"INSERT INTO Employees VALUES(0,0,{departmentList[departmentIndex]},'{firstNames[firstNameIndex]}','{lastNames[lastNameIndex]}',{contractID});");
            //        }

            //        writer.WriteLine("");
            //    }
            //}

            // Only for 10 devs.
            using (StreamWriter writer = new StreamWriter("Devs.txt"))
            {
               // for (int contractID = 1; contractID <= companyMaxAmount; contractID++)
                {
                    employeeMaxAmount = 10;

                    for (int k = 0; k < employeeMaxAmount; k++)
                    {
                        firstNameIndex = rand.Next(50);
                        lastNameIndex = rand.Next(50);
                        
                        writer.WriteLine($"INSERT INTO Employees VALUES(0,0,{departmentList[0]},'{firstNames[firstNameIndex]}','{lastNames[lastNameIndex]}',7);");
                    }

                    writer.WriteLine("");
                }
            }
        }
    }
}
