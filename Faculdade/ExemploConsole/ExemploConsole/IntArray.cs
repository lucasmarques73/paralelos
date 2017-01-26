using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ExemploConsole
{
    public class IntArray
    {
        private int[,] arr;

        public IntArray(int sizeP, int sizeQ)
        {
            if ((sizeP <= 0) && (sizeQ <= 0))
            {
                throw new Exception("arrays n pdem ser negativo");
            }
            arr = new int[sizeP, sizeQ];
            {
                for (int x = 0; x < sizeP; x++)
                {
                    for (int y = 0; y < sizeQ; y++) ;
                }
                arr[sizeP, sizeQ] = 0;// me da erro aqui
            }

        }


        public int sizeP
        {
            get
            {
                return sizeP;
            }
        }

        public int sizeQ
        {
            get
            {
                return sizeQ;
            }
        }

        public int this[int index0, int index1]
        {
            get
            {
                if ((index0 < 0) && (index1 < 0))
                {
                    throw new Exception("nao podem ser zero nem negativos os indexs");
                }
                if ((index0 >= sizeP) && (index1 >= sizeQ))
                {
                    throw new Exception(" nao podem ser maior que os arrays");
                }
                return arr[index0, index1];
            }
            set
            {
                if ((index0 < 0) && (index1 < 0))
                {
                    throw new Exception("nao podm ser negativo nem zero");
                }
                if ((index0 >= sizeP) && (index1 >= sizeQ))
                {
                    throw new Exception(" nunca maior que os arrays");
                }
                if (value < 0)
                {
                    value = value * (-1);
                }
                arr[index0, index1] = value;
            }
        }
    }
}
