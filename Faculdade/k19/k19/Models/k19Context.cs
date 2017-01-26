using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;

namespace k19.Models
{
    public class k19Context : DbContext
    {
        public DbSet<Editora> Editoras { get; set; }

        public DbSet<Livro> Livros { get; set; }

    }
}