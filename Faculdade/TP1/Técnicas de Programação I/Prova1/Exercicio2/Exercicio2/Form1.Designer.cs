namespace Exercicio2
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.lbTexto = new System.Windows.Forms.Label();
            this.lbTextoConvertido = new System.Windows.Forms.Label();
            this.btConverter = new System.Windows.Forms.Button();
            this.tbTextoConvertido = new System.Windows.Forms.TextBox();
            this.tbTexto = new System.Windows.Forms.TextBox();
            this.SuspendLayout();
            // 
            // lbTexto
            // 
            this.lbTexto.AutoSize = true;
            this.lbTexto.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTexto.Location = new System.Drawing.Point(21, 24);
            this.lbTexto.Name = "lbTexto";
            this.lbTexto.Size = new System.Drawing.Size(47, 16);
            this.lbTexto.TabIndex = 92;
            this.lbTexto.Text = "Texto";
            this.lbTexto.Click += new System.EventHandler(this.lbNome_Click);
            // 
            // lbTextoConvertido
            // 
            this.lbTextoConvertido.AutoSize = true;
            this.lbTextoConvertido.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbTextoConvertido.Location = new System.Drawing.Point(21, 71);
            this.lbTextoConvertido.Name = "lbTextoConvertido";
            this.lbTextoConvertido.Size = new System.Drawing.Size(126, 16);
            this.lbTextoConvertido.TabIndex = 93;
            this.lbTextoConvertido.Text = "Texto Convertido";
            // 
            // btConverter
            // 
            this.btConverter.BackColor = System.Drawing.Color.Transparent;
            this.btConverter.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.btConverter.Location = new System.Drawing.Point(260, 161);
            this.btConverter.Name = "btConverter";
            this.btConverter.Size = new System.Drawing.Size(97, 23);
            this.btConverter.TabIndex = 105;
            this.btConverter.Text = "Converter";
            this.btConverter.UseVisualStyleBackColor = false;
            this.btConverter.Click += new System.EventHandler(this.btConverter_Click);
            // 
            // tbTextoConvertido
            // 
            this.tbTextoConvertido.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbTextoConvertido.Location = new System.Drawing.Point(181, 68);
            this.tbTextoConvertido.Name = "tbTextoConvertido";
            this.tbTextoConvertido.Size = new System.Drawing.Size(492, 22);
            this.tbTextoConvertido.TabIndex = 106;
            // 
            // tbTexto
            // 
            this.tbTexto.Font = new System.Drawing.Font("Microsoft Sans Serif", 9.75F, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tbTexto.Location = new System.Drawing.Point(181, 21);
            this.tbTexto.Name = "tbTexto";
            this.tbTexto.Size = new System.Drawing.Size(492, 22);
            this.tbTexto.TabIndex = 107;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(708, 299);
            this.Controls.Add(this.tbTexto);
            this.Controls.Add(this.tbTextoConvertido);
            this.Controls.Add(this.btConverter);
            this.Controls.Add(this.lbTextoConvertido);
            this.Controls.Add(this.lbTexto);
            this.Name = "Form1";
            this.Text = "Form1";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lbTexto;
        private System.Windows.Forms.Label lbTextoConvertido;
        private System.Windows.Forms.Button btConverter;
        private System.Windows.Forms.TextBox tbTextoConvertido;
        private System.Windows.Forms.TextBox tbTexto;
    }
}

