namespace aula_19_08_cadastro_acg
{
    partial class Form1
    {
        /// <summary>
        /// Variável de designer necessária.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Limpar os recursos que estão sendo usados.
        /// </summary>
        /// <param name="disposing">verdade se for necessário descartar os recursos gerenciados; caso contrário, falso.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region código gerado pelo Windows Form Designer

        /// <summary>
        /// Método necessário para suporte do Designer - não modifique
        /// o conteúdo deste método com o editor de código.
        /// </summary>
        private void InitializeComponent()
        {
            this.lbNomeEvento = new System.Windows.Forms.Label();
            this.lbTipo = new System.Windows.Forms.Label();
            this.lbCargaHoraria = new System.Windows.Forms.Label();
            this.lbData = new System.Windows.Forms.Label();
            this.lbObs = new System.Windows.Forms.Label();
            this.lbEntidade = new System.Windows.Forms.Label();
            this.tbNomeEvento = new System.Windows.Forms.TextBox();
            this.tbCargaHoraria = new System.Windows.Forms.TextBox();
            this.tbObs = new System.Windows.Forms.TextBox();
            this.tbLista = new System.Windows.Forms.TextBox();
            this.tbEntidade = new System.Windows.Forms.TextBox();
            this.dtData = new System.Windows.Forms.DateTimePicker();
            this.cbTipo = new System.Windows.Forms.ComboBox();
            this.btSalvar = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btFechar = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // lbNomeEvento
            // 
            this.lbNomeEvento.AutoSize = true;
            this.lbNomeEvento.Location = new System.Drawing.Point(12, 24);
            this.lbNomeEvento.Name = "lbNomeEvento";
            this.lbNomeEvento.Size = new System.Drawing.Size(78, 13);
            this.lbNomeEvento.TabIndex = 0;
            this.lbNomeEvento.Text = "Nome Evento :";
            this.lbNomeEvento.Click += new System.EventHandler(this.label1_Click);
            // 
            // lbTipo
            // 
            this.lbTipo.AutoSize = true;
            this.lbTipo.Location = new System.Drawing.Point(350, 24);
            this.lbTipo.Name = "lbTipo";
            this.lbTipo.Size = new System.Drawing.Size(34, 13);
            this.lbTipo.TabIndex = 1;
            this.lbTipo.Text = "Tipo :";
            // 
            // lbCargaHoraria
            // 
            this.lbCargaHoraria.AutoSize = true;
            this.lbCargaHoraria.Location = new System.Drawing.Point(12, 55);
            this.lbCargaHoraria.Name = "lbCargaHoraria";
            this.lbCargaHoraria.Size = new System.Drawing.Size(78, 13);
            this.lbCargaHoraria.TabIndex = 2;
            this.lbCargaHoraria.Text = "Carga Horária :";
            // 
            // lbData
            // 
            this.lbData.AutoSize = true;
            this.lbData.Location = new System.Drawing.Point(350, 58);
            this.lbData.Name = "lbData";
            this.lbData.Size = new System.Drawing.Size(36, 13);
            this.lbData.TabIndex = 3;
            this.lbData.Text = "Data :";
            // 
            // lbObs
            // 
            this.lbObs.AutoSize = true;
            this.lbObs.Location = new System.Drawing.Point(55, 118);
            this.lbObs.Name = "lbObs";
            this.lbObs.Size = new System.Drawing.Size(35, 13);
            this.lbObs.TabIndex = 4;
            this.lbObs.Text = "OBS.:";
            // 
            // lbEntidade
            // 
            this.lbEntidade.AutoSize = true;
            this.lbEntidade.Location = new System.Drawing.Point(35, 91);
            this.lbEntidade.Name = "lbEntidade";
            this.lbEntidade.Size = new System.Drawing.Size(55, 13);
            this.lbEntidade.TabIndex = 5;
            this.lbEntidade.Text = "Entidade :";
            // 
            // tbNomeEvento
            // 
            this.tbNomeEvento.Location = new System.Drawing.Point(88, 21);
            this.tbNomeEvento.Name = "tbNomeEvento";
            this.tbNomeEvento.Size = new System.Drawing.Size(256, 20);
            this.tbNomeEvento.TabIndex = 6;
            // 
            // tbCargaHoraria
            // 
            this.tbCargaHoraria.Location = new System.Drawing.Point(88, 55);
            this.tbCargaHoraria.Name = "tbCargaHoraria";
            this.tbCargaHoraria.Size = new System.Drawing.Size(88, 20);
            this.tbCargaHoraria.TabIndex = 7;
            // 
            // tbObs
            // 
            this.tbObs.Location = new System.Drawing.Point(88, 118);
            this.tbObs.Multiline = true;
            this.tbObs.Name = "tbObs";
            this.tbObs.Size = new System.Drawing.Size(420, 77);
            this.tbObs.TabIndex = 8;
            // 
            // tbLista
            // 
            this.tbLista.Location = new System.Drawing.Point(29, 201);
            this.tbLista.Multiline = true;
            this.tbLista.Name = "tbLista";
            this.tbLista.Size = new System.Drawing.Size(493, 105);
            this.tbLista.TabIndex = 9;
            // 
            // tbEntidade
            // 
            this.tbEntidade.Location = new System.Drawing.Point(88, 88);
            this.tbEntidade.Name = "tbEntidade";
            this.tbEntidade.Size = new System.Drawing.Size(256, 20);
            this.tbEntidade.TabIndex = 10;
            // 
            // dtData
            // 
            this.dtData.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtData.Location = new System.Drawing.Point(390, 55);
            this.dtData.Name = "dtData";
            this.dtData.Size = new System.Drawing.Size(92, 20);
            this.dtData.TabIndex = 11;
            // 
            // cbTipo
            // 
            this.cbTipo.FormattingEnabled = true;
            this.cbTipo.Location = new System.Drawing.Point(390, 20);
            this.cbTipo.Name = "cbTipo";
            this.cbTipo.Size = new System.Drawing.Size(87, 21);
            this.cbTipo.TabIndex = 12;
            // 
            // btSalvar
            // 
            this.btSalvar.Location = new System.Drawing.Point(29, 314);
            this.btSalvar.Name = "btSalvar";
            this.btSalvar.Size = new System.Drawing.Size(75, 23);
            this.btSalvar.TabIndex = 13;
            this.btSalvar.Text = "Salvar";
            this.btSalvar.UseVisualStyleBackColor = true;
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(219, 314);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 14;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            // 
            // btFechar
            // 
            this.btFechar.Location = new System.Drawing.Point(389, 314);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 15;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = true;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(563, 349);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvar);
            this.Controls.Add(this.cbTipo);
            this.Controls.Add(this.dtData);
            this.Controls.Add(this.tbEntidade);
            this.Controls.Add(this.tbLista);
            this.Controls.Add(this.tbObs);
            this.Controls.Add(this.tbCargaHoraria);
            this.Controls.Add(this.tbNomeEvento);
            this.Controls.Add(this.lbEntidade);
            this.Controls.Add(this.lbObs);
            this.Controls.Add(this.lbData);
            this.Controls.Add(this.lbCargaHoraria);
            this.Controls.Add(this.lbTipo);
            this.Controls.Add(this.lbNomeEvento);
            this.Name = "Form1";
            this.Text = "Cadastro de ACG";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lbNomeEvento;
        private System.Windows.Forms.Label lbTipo;
        private System.Windows.Forms.Label lbCargaHoraria;
        private System.Windows.Forms.Label lbData;
        private System.Windows.Forms.Label lbObs;
        private System.Windows.Forms.Label lbEntidade;
        private System.Windows.Forms.TextBox tbNomeEvento;
        private System.Windows.Forms.TextBox tbCargaHoraria;
        private System.Windows.Forms.TextBox tbObs;
        private System.Windows.Forms.TextBox tbLista;
        private System.Windows.Forms.TextBox tbEntidade;
        private System.Windows.Forms.DateTimePicker dtData;
        private System.Windows.Forms.ComboBox cbTipo;
        private System.Windows.Forms.Button btSalvar;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btFechar;
    }
}

