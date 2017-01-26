using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using k19.Models;

namespace k19.Controllers
{
    public class LivroController : Controller
    {
        private k19Context db = new k19Context();

        //
        // GET: /Livro/

        public ActionResult Index()
        {
            var livros = db.Livros.Include(l => l.Editora);
            return View(livros.ToList());
        }

        //
        // GET: /Livro/Details/5

        public ActionResult Details(int id = 0)
        {
            Livro livro = db.Livros.Find(id);
            if (livro == null)
            {
                return HttpNotFound();
            }
            return View(livro);
        }

        //
        // GET: /Livro/Create

        public ActionResult Create()
        {
            ViewBag.EditoraID = new SelectList(db.Editoras, "EditoraID", "Nome");
            return View();
        }

        //
        // POST: /Livro/Create

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(Livro livro)
        {
            if (ModelState.IsValid)
            {
                db.Livros.Add(livro);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.EditoraID = new SelectList(db.Editoras, "EditoraID", "Nome", livro.EditoraID);
            return View(livro);
        }

        //
        // GET: /Livro/Edit/5

        public ActionResult Edit(int id = 0)
        {
            Livro livro = db.Livros.Find(id);
            if (livro == null)
            {
                return HttpNotFound();
            }
            ViewBag.EditoraID = new SelectList(db.Editoras, "EditoraID", "Nome", livro.EditoraID);
            return View(livro);
        }

        //
        // POST: /Livro/Edit/5

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit(Livro livro)
        {
            if (ModelState.IsValid)
            {
                db.Entry(livro).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.EditoraID = new SelectList(db.Editoras, "EditoraID", "Nome", livro.EditoraID);
            return View(livro);
        }

        //
        // GET: /Livro/Delete/5

        public ActionResult Delete(int id = 0)
        {
            Livro livro = db.Livros.Find(id);
            if (livro == null)
            {
                return HttpNotFound();
            }
            return View(livro);
        }

        //
        // POST: /Livro/Delete/5

        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Livro livro = db.Livros.Find(id);
            db.Livros.Remove(livro);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            db.Dispose();
            base.Dispose(disposing);
        }
    }
}