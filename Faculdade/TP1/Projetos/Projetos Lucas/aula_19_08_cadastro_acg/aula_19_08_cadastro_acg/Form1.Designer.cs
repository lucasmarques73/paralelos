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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.lbNomeEvento = new System.Windows.Forms.Label();
            this.lbTipo = new System.Windows.Forms.Label();
            this.lbCargaHoraria = new System.Windows.Forms.Label();
            this.lbData = new System.Windows.Forms.Label();
            this.lbObs = new System.Windows.Forms.Label();
            this.lbEntidade = new System.Windows.Forms.Label();
            this.tbNomeEvento = new System.Windows.Forms.TextBox();
            this.tbCargaHoraria = new System.Windows.Forms.TextBox();
            this.tbObs = new System.Windows.Forms.TextBox();
            this.tbEntidade = new System.Windows.Forms.TextBox();
            this.dtData = new System.Windows.Forms.DateTimePicker();
            this.cbTipo = new System.Windows.Forms.ComboBox();
            this.btSalvar = new System.Windows.Forms.Button();
            this.btLimpar = new System.Windows.Forms.Button();
            this.btFechar = new System.Windows.Forms.Button();
            this.lbLista = new System.Windows.Forms.Label();
            this.shapeContainer1 = new Microsoft.VisualBasic.PowerPacks.ShapeContainer();
            this.lineShape1 = new Microsoft.VisualBasic.PowerPacks.LineShape();
            this.dgLista = new System.Windows.Forms.DataGridView();
            this.dgNomeEvento = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dgTipo = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dgCargaHoraria = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dgData = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dgEntidade = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.dgObs = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.dgLista)).BeginInit();
            this.SuspendLayout();
            // 
            // lbNomeEvento
            // 
            this.lbNomeEvento.AutoSize = true;
            this.lbNomeEvento.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbNomeEvento.Location = new System.Drawing.Point(-1, 24);
            this.lbNomeEvento.Name = "lbNomeEvento";
            this.lbNomeEvento.Size = new System.Drawing.Size(91, 13);
            this.lbNomeEvento.TabIndex = 0;
            this.lbNomeEvento.Text = "Nome Evento :";
            this.lbNomeEvento.Click += new System.EventHandler(this.label1_Click);
            // 
            // lbTipo
            // 
            this.lbTipo.AutoSize = true;
            this.lbTipo.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTipo.Location = new System.Drawing.Point(398, 20);
            this.lbTipo.Name = "lbTipo";
            this.lbTipo.Size = new System.Drawing.Size(40, 13);
            this.lbTipo.TabIndex = 1;
            this.lbTipo.Text = "Tipo :";
            // 
            // lbCargaHoraria
            // 
            this.lbCargaHoraria.AutoSize = true;
            this.lbCargaHoraria.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbCargaHoraria.Location = new System.Drawing.Point(-1, 58);
            this.lbCargaHoraria.Name = "lbCargaHoraria";
            this.lbCargaHoraria.Size = new System.Drawing.Size(93, 13);
            this.lbCargaHoraria.TabIndex = 2;
            this.lbCargaHoraria.Text = "Carga Horária :";
            // 
            // lbData
            // 
            this.lbData.AutoSize = true;
            this.lbData.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbData.Location = new System.Drawing.Point(398, 54);
            this.lbData.Name = "lbData";
            this.lbData.Size = new System.Drawing.Size(42, 13);
            this.lbData.TabIndex = 3;
            this.lbData.Text = "Data :";
            // 
            // lbObs
            // 
            this.lbObs.AutoSize = true;
            this.lbObs.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbObs.Location = new System.Drawing.Point(51, 118);
            this.lbObs.Name = "lbObs";
            this.lbObs.Size = new System.Drawing.Size(40, 13);
            this.lbObs.TabIndex = 4;
            this.lbObs.Text = "OBS.:";
            // 
            // lbEntidade
            // 
            this.lbEntidade.AutoSize = true;
            this.lbEntidade.Font = new System.Drawing.Font("Microsoft Sans Serif", 8.25F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbEntidade.Location = new System.Drawing.Point(26, 91);
            this.lbEntidade.Name = "lbEntidade";
            this.lbEntidade.Size = new System.Drawing.Size(65, 13);
            this.lbEntidade.TabIndex = 5;
            this.lbEntidade.Text = "Entidade :";
            // 
            // tbNomeEvento
            // 
            this.tbNomeEvento.Location = new System.Drawing.Point(96, 20);
            this.tbNomeEvento.Name = "tbNomeEvento";
            this.tbNomeEvento.Size = new System.Drawing.Size(296, 20);
            this.tbNomeEvento.TabIndex = 0;
            // 
            // tbCargaHoraria
            // 
            this.tbCargaHoraria.Location = new System.Drawing.Point(96, 55);
            this.tbCargaHoraria.Name = "tbCargaHoraria";
            this.tbCargaHoraria.Size = new System.Drawing.Size(113, 20);
            this.tbCargaHoraria.TabIndex = 2;
            // 
            // tbObs
            // 
            this.tbObs.Location = new System.Drawing.Point(96, 118);
            this.tbObs.Multiline = true;
            this.tbObs.Name = "tbObs";
            this.tbObs.Size = new System.Drawing.Size(434, 77);
            this.tbObs.TabIndex = 5;
            // 
            // tbEntidade
            // 
            this.tbEntidade.Location = new System.Drawing.Point(96, 88);
            this.tbEntidade.Name = "tbEntidade";
            this.tbEntidade.Size = new System.Drawing.Size(434, 20);
            this.tbEntidade.TabIndex = 4;
            // 
            // dtData
            // 
            this.dtData.Format = System.Windows.Forms.DateTimePickerFormat.Short;
            this.dtData.Location = new System.Drawing.Point(438, 51);
            this.dtData.Name = "dtData";
            this.dtData.Size = new System.Drawing.Size(92, 20);
            this.dtData.TabIndex = 3;
            // 
            // cbTipo
            // 
            this.cbTipo.FormattingEnabled = true;
            this.cbTipo.Items.AddRange(new object[] {
            "Trabalho Voluntário",
            "Seminário",
            "Palestra",
            "Estágio",
            "Cursos",
            "Visita Técnica"});
            this.cbTipo.Location = new System.Drawing.Point(438, 16);
            this.cbTipo.Name = "cbTipo";
            this.cbTipo.Size = new System.Drawing.Size(92, 21);
            this.cbTipo.TabIndex = 1;
            // 
            // btSalvar
            // 
            this.btSalvar.Location = new System.Drawing.Point(29, 394);
            this.btSalvar.Name = "btSalvar";
            this.btSalvar.Size = new System.Drawing.Size(75, 23);
            this.btSalvar.TabIndex = 13;
            this.btSalvar.Text = "Salvar";
            this.btSalvar.UseVisualStyleBackColor = true;
            this.btSalvar.Click += new System.EventHandler(this.btSalvar_Click);
            // 
            // btLimpar
            // 
            this.btLimpar.Location = new System.Drawing.Point(248, 394);
            this.btLimpar.Name = "btLimpar";
            this.btLimpar.Size = new System.Drawing.Size(75, 23);
            this.btLimpar.TabIndex = 14;
            this.btLimpar.Text = "Limpar";
            this.btLimpar.UseVisualStyleBackColor = true;
            this.btLimpar.Click += new System.EventHandler(this.btLimpar_Click);
            // 
            // btFechar
            // 
            this.btFechar.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Center;
            this.btFechar.Location = new System.Drawing.Point(447, 394);
            this.btFechar.Name = "btFechar";
            this.btFechar.Size = new System.Drawing.Size(75, 23);
            this.btFechar.TabIndex = 15;
            this.btFechar.Text = "Fechar";
            this.btFechar.UseVisualStyleBackColor = true;
            this.btFechar.Click += new System.EventHandler(this.btFechar_Click);
            // 
            // lbLista
            // 
            this.lbLista.AutoSize = true;
            this.lbLista.Font = new System.Drawing.Font("Microsoft Sans Serif", 12F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbLista.Location = new System.Drawing.Point(25, 214);
            this.lbLista.Name = "lbLista";
            this.lbLista.Size = new System.Drawing.Size(48, 20);
            this.lbLista.TabIndex = 16;
            this.lbLista.Text = "Lista";
            // 
            // shapeContainer1
            // 
            this.shapeContainer1.Location = new System.Drawing.Point(0, 0);
            this.shapeContainer1.Margin = new System.Windows.Forms.Padding(0);
            this.shapeContainer1.Name = "shapeContainer1";
            this.shapeContainer1.Shapes.AddRange(new Microsoft.VisualBasic.PowerPacks.Shape[] {
            this.lineShape1});
            this.shapeContainer1.Size = new System.Drawing.Size(563, 439);
            this.shapeContainer1.TabIndex = 17;
            this.shapeContainer1.TabStop = false;
            // 
            // lineShape1
            // 
            this.lineShape1.Name = "lineShape1";
            this.lineShape1.X1 = -7;
            this.lineShape1.X2 = 586;
            this.lineShape1.Y1 = 205;
            this.lineShape1.Y2 = 205;
            // 
            // dgLista
            // 
            this.dgLista.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgLista.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.dgNomeEvento,
            this.dgTipo,
            this.dgCargaHoraria,
            this.dgData,
            this.dgEntidade,
            this.dgObs});
            this.dgLista.Location = new System.Drawing.Point(27, 237);
            this.dgLista.Name = "dgLista";
            this.dgLista.Size = new System.Drawing.Size(503, 127);
            this.dgLista.TabIndex = 18;
            this.dgLista.CellContentClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.dataGridView1_CellContentClick);
            // 
            // dgNomeEvento
            // 
            this.dgNomeEvento.HeaderText = "Nome Evento";
            this.dgNomeEvento.Name = "dgNomeEvento";
            // 
            // dgTipo
            // 
            this.dgTipo.HeaderText = "Tipo";
            this.dgTipo.Name = "dgTipo";
            // 
            // dgCargaHoraria
            // 
            this.dgCargaHoraria.HeaderText = "Carga Horária";
            this.dgCargaHoraria.Name = "dgCargaHoraria";
            // 
            // dgData
            // 
            this.dgData.HeaderText = "Data";
            this.dgData.Name = "dgData";
            // 
            // dgEntidade
            // 
            this.dgEntidade.HeaderText = "Entidade";
            this.dgEntidade.Name = "dgEntidade";
            // 
            // dgObs
            // 
            this.dgObs.HeaderText = "Obs";
            this.dgObs.Name = "dgObs";
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.Color.RoyalBlue;
            this.ClientSize = new System.Drawing.Size(563, 439);
            this.Controls.Add(this.dgLista);
            this.Controls.Add(this.lbLista);
            this.Controls.Add(this.btFechar);
            this.Controls.Add(this.btLimpar);
            this.Controls.Add(this.btSalvar);
            this.Controls.Add(this.cbTipo);
            this.Controls.Add(this.dtData);
            this.Controls.Add(this.tbEntidade);
            this.Controls.Add(this.tbObs);
            this.Controls.Add(this.tbCargaHoraria);
            this.Controls.Add(this.tbNomeEvento);
            this.Controls.Add(this.lbEntidade);
            this.Controls.Add(this.lbObs);
            this.Controls.Add(this.lbData);
            this.Controls.Add(this.lbCargaHoraria);
            this.Controls.Add(this.lbTipo);
            this.Controls.Add(this.lbNomeEvento);
            this.Controls.Add(this.shapeContainer1);
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Form1";
            this.Text = "Cadastro de ACG";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.dgLista)).EndInit();
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
        private System.Windows.Forms.TextBox tbEntidade;
        private System.Windows.Forms.DateTimePicker dtData;
        private System.Windows.Forms.ComboBox cbTipo;
        private System.Windows.Forms.Button btSalvar;
        private System.Windows.Forms.Button btLimpar;
        private System.Windows.Forms.Button btFechar;
        private System.Windows.Forms.Label lbLista;
        private Microsoft.VisualBasic.PowerPacks.ShapeContainer shapeContainer1;
        private Microsoft.VisualBasic.PowerPacks.LineShape lineShape1;
        private System.Windows.Forms.DataGridView dgLista;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgNomeEvento;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgTipo;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgCargaHoraria;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgData;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgEntidade;
        private System.Windows.Forms.DataGridViewTextBoxColumn dgObs;
    }
}

