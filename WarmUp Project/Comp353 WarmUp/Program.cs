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
            List<string> departmentList = new List<string>{ "'Development'", "'QA'", "'UI'", "'Design'", "'BusinessIntelligence'", "'Networking'" };

            Random rand = new Random();
            int employeeMaxAmount;
            int companyMaxAmount = 6;
            int departmentIndex;

            using (StreamWriter writer = new StreamWriter("Employees.txt"))
            {
                for (int companyNumber = 1; companyNumber <= companyMaxAmount; companyNumber++)
                {
                    employeeMaxAmount = rand.Next(4, 12);
                    for (int k = 0; k < employeeMaxAmount; k++)
                    {
                        departmentIndex = rand.Next(6);
                        writer.WriteLine($"INSERT INTO Employees VALUES(0,0,{departmentList[departmentIndex]},{companyNumber});");
                    }

                    writer.WriteLine("");
                }
            }
        }
    }
}
