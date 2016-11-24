using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using ClassReserva;

namespace MvcReserva.Controllers
{
    public class AeropuertoController : Controller
    {
        private DBReserva db = new DBReserva();

        //
        // GET: /Aeropuerto/

        public ActionResult Index()
        {
            var aeropuerto = db.AEROPUERTO.Include(a => a.PAIS);
            return View(aeropuerto.ToList());
        }

        //
        // GET: /Aeropuerto/Details/5

        public ActionResult Details(string id = null)
        {
            AEROPUERTO aeropuerto = db.AEROPUERTO.Find(id);
            if (aeropuerto == null)
            {
                return HttpNotFound();
            }
            return View(aeropuerto);
        }

        //
        // GET: /Aeropuerto/Create

        public ActionResult Create()
        {
            ViewBag.idpais = new SelectList(db.PAIS, "idpais", "nombre");
            return View();
        }

        //
        // POST: /Aeropuerto/Create

        [HttpPost]
        public ActionResult Create(AEROPUERTO aeropuerto)
        {
            if (ModelState.IsValid)
            {
                db.AEROPUERTO.Add(aeropuerto);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.idpais = new SelectList(db.PAIS, "idpais", "nombre", aeropuerto.idpais);
            return View(aeropuerto);
        }

        //
        // GET: /Aeropuerto/Edit/5

        public ActionResult Edit(string id = null)
        {
            AEROPUERTO aeropuerto = db.AEROPUERTO.Find(id);
            if (aeropuerto == null)
            {
                return HttpNotFound();
            }
            ViewBag.idpais = new SelectList(db.PAIS, "idpais", "nombre", aeropuerto.idpais);
            return View(aeropuerto);
        }

        //
        // POST: /Aeropuerto/Edit/5

        [HttpPost]
        public ActionResult Edit(AEROPUERTO aeropuerto)
        {
            if (ModelState.IsValid)
            {
                db.Entry(aeropuerto).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.idpais = new SelectList(db.PAIS, "idpais", "nombre", aeropuerto.idpais);
            return View(aeropuerto);
        }

        //
        // GET: /Aeropuerto/Delete/5

        public ActionResult Delete(string id = null)
        {
            AEROPUERTO aeropuerto = db.AEROPUERTO.Find(id);
            if (aeropuerto == null)
            {
                return HttpNotFound();
            }
            return View(aeropuerto);
        }

        //
        // POST: /Aeropuerto/Delete/5

        [HttpPost, ActionName("Delete")]
        public ActionResult DeleteConfirmed(string id)
        {
            AEROPUERTO aeropuerto = db.AEROPUERTO.Find(id);
            db.AEROPUERTO.Remove(aeropuerto);
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