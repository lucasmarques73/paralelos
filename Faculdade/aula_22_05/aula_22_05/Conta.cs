using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace aula_22_05
{
    class Conta
    {

        private double saldo;

        public void depositar(double valor)
        {
            saldo += valor;
        }

        public void sacar(double valor)
        {
            saldo -= valor;
        }


    }
}
